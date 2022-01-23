<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpProvinsi;
use App\Models\Provinsi;
use App\Models\Logo;

class HomeController extends Controller
{
    public function index()
    {
        $indexPage="Dashboard";
        $totalppprov=PpProvinsi::count();
        $totalppprovnilai=PpProvinsi::sum('nilai_produksi');
        $totalppprovvolume=PpProvinsi::sum('volume_produksi');
        $totalprovinsi=Provinsi::count();

        $data = array(
            'indexPage' => $indexPage,
            'totalppprov' => $totalppprov,
            'totalppprovnilai' => $totalppprovnilai,
            'totalppprovvolume' => $totalppprovvolume,
            'totalprovinsi' => $totalprovinsi,
        );

        return view('frontend.index')->with($data);
    }

    public function ppprov()
    {
        $indexPage="Produksi Perikanan";
        $year = ['2018','2019','2020','2021','2022'];
        
        $volume = [];
        foreach ($year as $key => $value) {
            $volume[] = PpProvinsi::where('tahun',$value)->sum('volume_produksi');
        }
        $nilai = [];
        foreach ($year as $key => $value) {
            $nilai[] = PpProvinsi::where('tahun',$value)->sum('nilai_produksi');
        }

        $data = array(
            'indexPage' => $indexPage,
            'year' => json_encode($year,JSON_NUMERIC_CHECK),
            'volume' => json_encode($volume,JSON_NUMERIC_CHECK),
            'nilai' => json_encode($nilai,JSON_NUMERIC_CHECK)
        );

        return view('frontend.produksi-perikanan.provinsi')->with($data);
    }
}
