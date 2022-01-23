<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB, Hash;
use App\Models\Logo;

class LogoController extends Controller
{
    protected $base = 'logo.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }

    public function index()
    {   
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Logo",
            'logo' => $logo
        );
        
        return view($this->base.'index')->with($data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'logo' => 'required',
        ]);
        $input = $request->all();
        
        $logo = $input['logo'];
		$name = date('Ymd').'-'.time().'.'.$logo->getClientOriginalExtension();
		$destinationPath = public_path('uploads/logo');
        $logo->move($destinationPath, $name);

        $input['logo'] = $name;

        $update = Logo::find(1);
        $update->update($input);

        return redirect()->route('logo')->with(['success' => 'Logo berhasil diupdate.']); 
    }
}
