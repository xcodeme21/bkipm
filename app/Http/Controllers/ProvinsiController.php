<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
    protected $base = 'provinsi.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $provinsi=Provinsi::all();

		$data = array(  
            'indexPage' => "Provinsi",
            'provinsi' => $provinsi
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
		$data = array(  
            'indexPage' => "Tambah Data Provinsi",
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $this->validate($request, [
            'provinsi' => 'required|unique:provinsi,provinsi',
        ]);
		$insert = Provinsi::create($request->except('_token'));

        return redirect()->route('provinsi')->with(['success' => 'Data provinsi ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=Provinsi::find($id);

		$data = array(  
            'indexPage' => "Update Data Provinsi",
            'rs' => $rs
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');

        $this->validate($request, [
            'provinsi' => 'required|unique:provinsi,provinsi,'.$id,
        ]);
        
		$update = Provinsi::whereId($id)->update($request->except('_token'));

        return redirect()->route('provinsi')->with(['success' => 'Data provinsi diupdate.']); 
    }

    public function delete($id)
    {
        $id = Provinsi::find($id);
        $id ->delete();

        return redirect()->route('provinsi')->with(['success' => 'Data provinsi dihapus.']);
    }
	
}
