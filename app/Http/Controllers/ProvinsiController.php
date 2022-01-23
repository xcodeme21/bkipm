<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Provinsi;
use App\Models\Logo;

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
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Provinsi",
            'provinsi' => $provinsi,
            'logo' => $logo
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Tambah Data Provinsi",
            'logo' => $logo
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
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Update Data Provinsi",
            'rs' => $rs,
            'logo' => $logo
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
