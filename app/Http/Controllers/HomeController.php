<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpProvinsi;
use App\Models\Provinsi;
use App\Models\Logo;
use App\Models\Impor;
use App\Models\ImporFrekuensi;
use App\Models\Ekspor;
use App\Models\EksporFrekuensi;

class HomeController extends Controller
{
    public function index()
    {
        $indexPage="Dashboard";
        $totalppprov=PpProvinsi::count();
        $totalppprovnilai=PpProvinsi::sum('nilai_produksi');
        $totalppprovvolume=PpProvinsi::sum('volume_produksi');
        $totalprovinsi=Provinsi::count();
        $logo=Logo::find(1);

        $data = array(
            'indexPage' => $indexPage,
            'totalppprov' => $totalppprov,
            'totalppprovnilai' => $totalppprovnilai,
            'totalppprovvolume' => $totalppprovvolume,
            'totalprovinsi' => $totalprovinsi,
            'logo' => $logo
        );

        return view('frontend.index')->with($data);
    }

    public function ppprov()
    {
        $logo=Logo::find(1);
        $indexPage="Produksi Perikanan";
        $thisYear=date('Y');
        $firstYear=strval((int)$thisYear - 5);
        $year = range($firstYear, $thisYear);
        
        $volume = [];
        foreach ($year as $key => $value) {
            $volume[] = PpProvinsi::where('tahun',$value)->sum('volume_produksi');
        }
        $nilai = [];
        foreach ($year as $key => $value) {
            $nilai[] = PpProvinsi::where('tahun',$value)->sum('nilai_produksi');
        }

        $totalVolume=array_sum($volume);
        $totalNilai=array_sum($nilai);

        $data = array(
            'indexPage' => $indexPage,
            'year' => json_encode($year,JSON_NUMERIC_CHECK),
            'volume' => json_encode($volume,JSON_NUMERIC_CHECK),
            'nilai' => json_encode($nilai,JSON_NUMERIC_CHECK),
            'totalVolume' => $totalVolume,
            'totalNilai' => $totalNilai,
            'logo' => $logo
        );

        return view('frontend.produksi-perikanan.provinsi')->with($data);
    }

    public function imporVolume()
    {
        $logo=Logo::find(1);
        $indexPage="Impor";
        $thisYear=date('Y');
        $firstYear=strval((int)$thisYear - 5);
        $year = range($firstYear, $thisYear);
        
        $volume = [];
        foreach ($year as $key => $value) {
            $volume[] = Impor::where('tahun',$value)->sum('volume_produksi');
        }
        $nilai = [];
        foreach ($year as $key => $value) {
            $nilai[] = Impor::where('tahun',$value)->sum('nilai_produksi');
        }

        $totalVolume=array_sum($volume);
        $totalNilai=array_sum($nilai);

        $data = array(
            'indexPage' => $indexPage,
            'year' => json_encode($year,JSON_NUMERIC_CHECK),
            'volume' => json_encode($volume,JSON_NUMERIC_CHECK),
            'nilai' => json_encode($nilai,JSON_NUMERIC_CHECK),
            'totalVolume' => $totalVolume,
            'totalNilai' => $totalNilai,
            'logo' => $logo
        );

        return view('frontend.impor.volume')->with($data);
    }

    public function imporFrekuensi()
    {
        $logo=Logo::find(1);
        $indexPage="Impor";
        $thisYear=date('Y');
        $firstYear=strval((int)$thisYear - 5);
        $year = range($firstYear, $thisYear);
        
        $frekuensi = [];
        foreach ($year as $key => $value) {
            $frekuensi[] = ImporFrekuensi::where('tahun',$value)->sum('frekuensi');
        }

        $totalFrekuensi=array_sum($frekuensi);

        $data = array(
            'indexPage' => $indexPage,
            'year' => json_encode($year,JSON_NUMERIC_CHECK),
            'frekuensi' => json_encode($frekuensi,JSON_NUMERIC_CHECK),
            'totalFrekuensi' => $totalFrekuensi,
            'logo' => $logo
        );

        return view('frontend.impor.frekuensi')->with($data);
    }

    public function eksporVolume()
    {
        $logo=Logo::find(1);
        $indexPage="Ekspor";
        $thisYear=date('Y');
        $firstYear=strval((int)$thisYear - 5);
        $year = range($firstYear, $thisYear);
        
        $volume = [];
        foreach ($year as $key => $value) {
            $volume[] = Ekspor::where('tahun',$value)->sum('volume_produksi');
        }
        $nilai = [];
        foreach ($year as $key => $value) {
            $nilai[] = Ekspor::where('tahun',$value)->sum('nilai_produksi');
        }

        $totalVolume=array_sum($volume);
        $totalNilai=array_sum($nilai);

        $data = array(
            'indexPage' => $indexPage,
            'year' => json_encode($year,JSON_NUMERIC_CHECK),
            'volume' => json_encode($volume,JSON_NUMERIC_CHECK),
            'nilai' => json_encode($nilai,JSON_NUMERIC_CHECK),
            'totalVolume' => $totalVolume,
            'totalNilai' => $totalNilai,
            'logo' => $logo
        );

        return view('frontend.ekspor.volume')->with($data);
    }

    public function eksporFrekuensi()
    {
        $logo=Logo::find(1);
        $indexPage="Ekspor";
        $thisYear=date('Y');
        $firstYear=strval((int)$thisYear - 5);
        $year = range($firstYear, $thisYear);
        
        $frekuensi = [];
        foreach ($year as $key => $value) {
            $frekuensi[] = EksporFrekuensi::where('tahun',$value)->sum('frekuensi');
        }

        $totalFrekuensi=array_sum($frekuensi);

        $data = array(
            'indexPage' => $indexPage,
            'year' => json_encode($year,JSON_NUMERIC_CHECK),
            'frekuensi' => json_encode($frekuensi,JSON_NUMERIC_CHECK),
            'totalFrekuensi' => $totalFrekuensi,
            'logo' => $logo
        );

        return view('frontend.ekspor.frekuensi')->with($data);
    }
}
