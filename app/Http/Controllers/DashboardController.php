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
		$data = array(  
            'indexPage' => "Dashboard",
        );
        
        return view($this->base.'index')->with($data);
    }
}
