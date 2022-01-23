<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\PpProvinsi;
use App\Models\JenisUsaha;
use App\Models\Provinsi;
use App\Models\JenisIkan;
use App\Models\Logo;

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
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Produksi Perikanan Provinsi",
            'provinsi' => $provinsi,
            'logo' => $logo
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
        $jenisusaha=JenisUsaha::all();
        $provinsi=Provinsi::all();
        $jenisikan=JenisIkan::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Tambah Produksi Perikanan Provinsi",
            'jenisusaha' => $jenisusaha,
            'provinsi' => $provinsi,
            'jenisikan' => $jenisikan,
            'logo' => $logo
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $this->validate($request, [
            'jenis_usaha_id' => 'required',
            'tahun' => 'required',
            'jenis_ikan_id' => 'required',
            'volume_produksi' => 'required',
        ]);
        $input = $request->all();
        $ji = JenisIkan::find($input['jenis_ikan_id']);
        $harga = $ji->harga;
        $input['nilai_produksi'] = $ji->harga * $input['volume_produksi'];
        unset($input['_token']);

        $checkDB = PpProvinsi::where('jenis_usaha_id', $input['jenis_usaha_id'])
        ->where('provinsi_id', $input['provinsi_id'])
        ->where('jenis_ikan_id', $input['jenis_ikan_id'])
        ->where('tahun', $input['tahun'])
        ->first();

        if($checkDB == null) {
            $insert = PpProvinsi::create($input);
        } else {
            $totalsebelumnya = $checkDB->volume_produksi;
            $input['volume_produksi'] = $totalsebelumnya + $input['volume_produksi'];
            $input['nilai_produksi'] = $ji->harga * $input['volume_produksi'];

            
            $checkDB = PpProvinsi::where('jenis_usaha_id', $input['jenis_usaha_id'])
            ->where('provinsi_id', $input['provinsi_id'])
            ->where('jenis_ikan_id', $input['jenis_ikan_id'])
            ->where('tahun', $input['tahun'])
            ->update($input);
        }	

        return redirect()->route('pp.provinsi')->with(['success' => 'Data produksi perikanan provinsi ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=PpProvinsi::find($id);
        $jenisusaha=JenisUsaha::all();
        $provinsi=Provinsi::all();
        $jenisikan=JenisIkan::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Update Produksi Perikanan Provinsi",
            'rs' => $rs,
            'jenisusaha' => $jenisusaha,
            'provinsi' => $provinsi,
            'jenisikan' => $jenisikan,
            'logo' => $logo
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');

        
        $this->validate($request, [
            'jenis_usaha_id' => 'required',
            'tahun' => 'required',
            'jenis_ikan_id' => 'required',
            'volume_produksi' => 'required',
        ]);
        $input = $request->all();
        $ji = JenisIkan::find($input['jenis_ikan_id']);
        $harga = $ji->harga;
        $input['nilai_produksi'] = $ji->harga * $input['volume_produksi'];
        unset($input['_token']);
        
		$update = PpProvinsi::whereId($id)->update($input);

        return redirect()->route('pp.provinsi')->with(['success' => 'Data produksi perikanan provinsi diupdate.']); 
    }

    public function delete($id)
    {
        $id = PpProvinsi::find($id);
        $id ->delete();

        return redirect()->route('pp.provinsi')->with(['success' => 'Data produksi perikanan provinsi dihapus.']);
    }
	
}
