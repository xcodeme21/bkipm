<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB, Validator;
use Yajra\Datatables\Datatables;
use App\Models\JenisIkan;

class JenisIkanController extends Controller
{
    protected $base = 'jenis-ikan.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $jenisikan=JenisIkan::all();

		$data = array(  
            'indexPage' => "Jenis Ikan",
            'jenisikan' => $jenisikan
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
		$data = array(  
            'indexPage' => "Tambah Jenis Ikan",
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $rules = [
            'jenis_ikan'  => 'required|unique:jenis_ikan',
            'harga' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Mohon pastikan isian Anda!']); 
        }
        $input = $request->except('_token');
        $input['harga'] = str_replace('.', '', $input['harga']);

		$insert = JenisIkan::create($input);

        return redirect()->route('jenis-ikan')->with(['success' => 'Jenis Usaha ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=JenisIkan::find($id);

		$data = array(  
            'indexPage' => "Update Jenis Ikan",
            'rs' => $rs
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');

        $rules = [
            'jenis_ikan'   => 'unique:jenis_ikan,jenis_ikan,' . $id,
            'harga' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Mohon pastikan isian Anda!']); 
        }
        
        $input = $request->except('_token');
        $input['harga'] = str_replace('.', '', $input['harga']);

		$update = JenisIkan::whereId($id)->update($input);

        return redirect()->route('jenis-ikan')->with(['success' => 'Jenis Usaha diupdate.']); 
    }

    public function delete($id)
    {
        $jenisikan = JenisIkan::find($id);
        $jenisikan ->delete();

        return redirect()->route('jenis-ikan')->with(['success' => 'Jenis Usaha dihapus.']);
    }
	
}
