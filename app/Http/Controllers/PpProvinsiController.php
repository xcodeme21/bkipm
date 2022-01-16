<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\PpProvinsi;

class PpProvinsiController extends Controller
{
    protected $base = 'produksi-perikanan.provinsi.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $provinsi=PpProvinsi::all();

		$data = array(  
            'indexPage' => "Produksi Perikanan Provinsi",
            'provinsi' => $provinsi
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
		$data = array(  
            'indexPage' => "Tambah Produksi Perikanan Provinsi",
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $this->validate($request, [
            'provinsi' => 'required|unique:provinsi,provinsi',
        ]);
		$insert = PpProvinsi::create($request->except('_token'));

        return redirect()->route('pp.provinsi')->with(['success' => 'Data produksi perikanan provinsi ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=PpProvinsi::find($id);

		$data = array(  
            'indexPage' => "Update Produksi Perikanan Provinsi",
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
        
		$update = PpProvinsi::whereId($id)->update($request->except('_token'));

        return redirect()->route('pp.provinsi')->with(['success' => 'Data produksi perikanan provinsi diupdate.']); 
    }

    public function delete($id)
    {
        $id = PpProvinsi::find($id);
        $id ->delete();

        return redirect()->route('pp.provinsi')->with(['success' => 'Data produksi perikanan provinsi dihapus.']);
    }
	
}
