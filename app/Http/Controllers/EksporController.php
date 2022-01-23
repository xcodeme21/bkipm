<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Ekspor;
use App\Models\EksporFrekuensi;
use App\Models\JenisIkan;
use App\Models\Logo;

class EksporController extends Controller
{
    protected $base = 'ekspor.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $ekspor=Ekspor::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Ekspor Volume",
            'ekspor' => $ekspor,
            'logo' => $logo
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
        $jenisikan=JenisIkan::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Tambah Ekspor Volume",
            'jenisikan' => $jenisikan,
            'logo' => $logo
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $this->validate($request, [
            'tahun' => 'required',
            'jenis_ikan_id' => 'required',
            'volume_produksi' => 'required',
        ]);
        $input = $request->all();
        $ji = JenisIkan::find($input['jenis_ikan_id']);
        $harga = $ji->harga;
        $input['nilai_produksi'] = $ji->harga * $input['volume_produksi'] / 14330;
        unset($input['_token']);

        $checkDB = Ekspor::where('jenis_ikan_id', $input['jenis_ikan_id'])
        ->where('tahun', $input['tahun'])
        ->first();

        if($checkDB == null) {
            $id = Ekspor::create($input)->id;
        } else {
            $totalsebelumnya = $checkDB->volume_produksi;
            $input['volume_produksi'] = $totalsebelumnya + $input['volume_produksi'];
            $input['nilai_produksi'] = $ji->harga * $input['volume_produksi'] / 14330;

            
            $ekspor = Ekspor::where('jenis_ikan_id', $input['jenis_ikan_id'])
            ->where('tahun', $input['tahun'])
            ->first();
            $ekspor->update($input);
            $id = $ekspor->id;

        }	

        $cekfrekuensi = EksporFrekuensi::where('ekspor_id',$id)->first();
        if($cekfrekuensi == null) {
            $inputFrekuensi=array(
                'ekspor_id' => $id,
                'frekuensi' => 1,
                'tahun' => $input['tahun']
            );
            $createFrekuensi=EksporFrekuensi::create($inputFrekuensi);
        } else {
            $inputFrekuensi=array(
                'ekspor_id' => $id,
                'frekuensi' => $cekfrekuensi->frekuensi + 1,
                'tahun' => $input['tahun']
            );
            $cekfrekuensi->update($inputFrekuensi);
        }

        return redirect()->route('ekspor.volume')->with(['success' => 'Data Ekspor ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=Ekspor::find($id);
        $jenisikan=JenisIkan::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Update Ekspor Volume",
            'rs' => $rs,
            'jenisikan' => $jenisikan,
            'logo' => $logo
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');

        
        $this->validate($request, [
            'tahun' => 'required',
            'jenis_ikan_id' => 'required',
            'volume_produksi' => 'required',
        ]);
        $input = $request->all();
        $ji = JenisIkan::find($input['jenis_ikan_id']);
        $harga = $ji->harga;
        $input['nilai_produksi'] = $ji->harga * $input['volume_produksi'] / 14330;
        unset($input['_token']);
        
        
		$update = Ekspor::whereId($id)->update($input);

        return redirect()->route('ekspor.volume')->with(['success' => 'Data Ekspor diupdate.']); 
    }

    public function delete($id)
    {
        $id = Ekspor::find($id);
        $id ->delete();

        return redirect()->route('ekspor.volume')->with(['success' => 'Data Ekspor dihapus.']);
    }
  
    public function indexFrekuensi()
    {
        $ekspor=EksporFrekuensi::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Ekspor Frekuensi",
            'ekspor' => $ekspor,
            'logo' => $logo
		);
        return view($this->base.'indexFrekuensi')->with($data);
    }
	
}
