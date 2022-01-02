<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use App\Models\StockOut;

class DashboardController extends Controller
{
    protected $base = 'dashboard.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }

    public function index()
    {   
        $monthbefore= date("m",strtotime("-1 month"));
        $yearbefore= date("Y",strtotime("-1 year"));
        $month= date('m');
        $year= date('Y');

        $revenue=StockOut::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('total_harga_produk');
        $sold=StockOut::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('total');
        
        if($month != "01")
        {
            $revenuebefore=StockOut::whereMonth('created_at', $monthbefore)->whereYear('created_at', $year)->sum('total_harga_produk');
            $soldbefore=StockOut::whereMonth('created_at', $monthbefore)->whereYear('created_at', $year)->sum('total');
        }
        else
        {
            $revenuebefore=StockOut::whereMonth('created_at', $monthbefore)->whereYear('created_at', $yearbefore)->sum('total_harga_produk');
            $soldbefore=StockOut::whereMonth('created_at', $monthbefore)->whereYear('created_at', $yearbefore)->sum('total');   
        }
        
        if((int) $revenue == 0 && (int) $revenuebefore == 0)
        {
            $averagerevenue=0;
            $averagesold=0;
        }
        else
        {
            if($revenuebefore == 0 && $soldbefore == 0)
            {
                $averagerevenue=100;
                $averagesold=100;
            }
            else
            {
                $averagerevenue= ((int) $revenue / $revenuebefore) * 100;
                $averagesold= ((int) $sold / $soldbefore) * 100;
            }
        }

        $week0=date("Y-m-01");
        $week1= date( "Y-m-d", strtotime( "$week0 +7 day" ) );
        $week2= date( "Y-m-d", strtotime( "$week1 +7 day" ) );
        $week3= date( "Y-m-d", strtotime( "$week2 +7 day" ) );
        $week4=date('Y-m-t');

        $revenue1=StockOut::whereBetween('created_at', [$week0, $week1])->sum('total_harga_produk');
        $revenue2=StockOut::whereBetween('created_at', [$week1, $week2])->sum('total_harga_produk');
        $revenue3=StockOut::whereBetween('created_at', [$week2, $week3])->sum('total_harga_produk');
        $revenue4=StockOut::whereBetween('created_at', [$week3, $week4])->sum('total_harga_produk');

        $sold1=StockOut::whereBetween('created_at', [$week0, $week1])->sum('total');
        $sold2=StockOut::whereBetween('created_at', [$week1, $week2])->sum('total');
        $sold3=StockOut::whereBetween('created_at', [$week2, $week3])->sum('total');
        $sold4=StockOut::whereBetween('created_at', [$week3, $week4])->sum('total');

        $bulan = json_encode("'Week 1', 'Week 2', 'Week 3', 'Week 4'"); 
        $revenueValue = json_encode("$revenue1, $revenue2, $revenue3, $revenue4");
        $soldValue = json_encode("$sold1, $sold2, $sold3, $sold4");
        
		$data = array(  
            'indexPage' => "Dashboard",
            'revenue' => $revenue,
            'sold' => $sold,
            'revenuebefore' => $revenuebefore,
            'soldbefore' => $soldbefore,
            'averagerevenue' => $averagerevenue,
            'averagesold' => $averagesold,
            'bulan' => $bulan,
            'revenueValue' => $revenueValue,
            'soldValue' => $soldValue,
        );
        
        return view($this->base.'index')->with($data);
    }
}
