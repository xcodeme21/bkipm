<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpProvinsi;
use App\Models\Provinsi;

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
        $indexPage="Produksi Perikanan Provinsi";
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

        return view('frontend.produksi-perikanan.provinsi')->with($data);
    }
}
