<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB, Validator;
use Yajra\Datatables\Datatables;
use App\Models\JenisUsaha;
use App\Models\Logo;

class JenisUsahaController extends Controller
{
    protected $base = 'jenis-usaha.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $jenisusaha=JenisUsaha::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Jenis Usaha",
            'jenisusaha' => $jenisusaha,
            'logo' => $logo
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
        $logo=Logo::find(1);
        
		$data = array(  
            'indexPage' => "Tambah Jenis Usaha",
            'logo' => $logo
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $rules = [
            'jenis_usaha'         => 'unique:jenis_usaha'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Jenis usaha sudah terdaftar.']); 
        }

		$insert = JenisUsaha::create($request->except('_token'));

        return redirect()->route('jenis-usaha')->with(['success' => 'Jenis Usaha ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=JenisUsaha::find($id);
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Update Jenis Usaha",
            'rs' => $rs,
            'logo' => $logo
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');

        $rules = [
            'jenis_usaha'         => 'unique:jenis_usaha,jenis_usaha,' . $id,
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return redirect()->back()->with(['error' => 'Jenis usaha sudah terdaftar.']); 
        }
        
		$update = JenisUsaha::whereId($id)->update($request->except('_token'));

        return redirect()->route('jenis-usaha')->with(['success' => 'Jenis Usaha diupdate.']); 
    }

    public function delete($id)
    {
        $jenisusaha = JenisUsaha::find($id);
        $jenisusaha ->delete();

        return redirect()->route('jenis-usaha')->with(['success' => 'Jenis Usaha dihapus.']);
    }
	
}
