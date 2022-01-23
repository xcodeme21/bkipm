<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB, Hash;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Models\Logo;

class ProfileController extends Controller
{
    protected $base = 'profile.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }

    public function index()
    {   
        $logo=Logo::find(1);

		$data = array(  
            'indexPage' => "Profile",
            'logo' => $logo
        );
        
        return view($this->base.'index')->with($data);
    }

    public function update(Request $request)
    {
        $id=auth()->user()->id;

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        $input = $request->all();
        if(!empty($input['password'])){ 
            if($input['password'] != $input['confirm_password'])
            {
                return redirect()->route('profile')->with(['error' => 'Password tidak sama!']); 
            }
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('profile')->with(['success' => 'Profile berhasil diupdate.']); 
    }
}
