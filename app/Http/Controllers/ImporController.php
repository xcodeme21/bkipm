<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Impor;
use App\Models\ImporFrekuensi;
use App\Models\JenisIkan;
use App\Models\Logo;

class ImporController extends Controller
{
    protected $base = 'impor.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $impor=Impor::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Impor Volume",
            'impor' => $impor,
            'logo' => $logo
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
        $jenisikan=JenisIkan::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Tambah Impor Volume",
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

        $checkDB = Impor::where('jenis_ikan_id', $input['jenis_ikan_id'])
        ->where('tahun', $input['tahun'])
        ->first();

        if($checkDB == null) {
            $id = Impor::create($input)->id;
        } else {
            $totalsebelumnya = $checkDB->volume_produksi;
            $input['volume_produksi'] = $totalsebelumnya + $input['volume_produksi'];
            $input['nilai_produksi'] = $ji->harga * $input['volume_produksi'] / 14330;

            
            $impor = Impor::where('jenis_ikan_id', $input['jenis_ikan_id'])
            ->where('tahun', $input['tahun'])
            ->first();
            $impor->update($input);
            $id = $impor->id;

        }	

        $cekfrekuensi = ImporFrekuensi::where('impor_id',$id)->first();
        if($cekfrekuensi == null) {
            $inputFrekuensi=array(
                'impor_id' => $id,
                'frekuensi' => 1
            );
            $createFrekuensi=ImporFrekuensi::create($inputFrekuensi);
        } else {
            $inputFrekuensi=array(
                'impor_id' => $id,
                'frekuensi' => $cekfrekuensi->frekuensi + 1
            );
            $cekfrekuensi->update($inputFrekuensi);
        }

        return redirect()->route('impor.volume')->with(['success' => 'Data Impor ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=Impor::find($id);
        $jenisikan=JenisIkan::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Update Impor Volume",
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
        
        
		$update = Impor::whereId($id)->update($input);

        return redirect()->route('impor.volume')->with(['success' => 'Data Impor diupdate.']); 
    }

    public function delete($id)
    {
        $id = Impor::find($id);
        $id ->delete();

        return redirect()->route('impor.volume')->with(['success' => 'Data Impor dihapus.']);
    }
  
    public function indexFrekuensi()
    {
        $impor=ImporFrekuensi::all();
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Impor Frekuensi",
            'impor' => $impor,
            'logo' => $logo
		);
        return view($this->base.'indexFrekuensi')->with($data);
    }
	
}
