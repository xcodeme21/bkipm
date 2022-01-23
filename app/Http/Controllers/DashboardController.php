<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use App\Models\Logo;

class DashboardController extends Controller
{
    protected $base = 'dashboard.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }

    public function index()
    {   
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Dashboard",
            'logo' => $logo
        );
        
        return view($this->base.'index')->with($data);
    }
}
