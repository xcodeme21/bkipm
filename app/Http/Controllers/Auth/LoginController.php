<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\User;
use App\Models\LoginFront;  
use Validator, Auth; 
use Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Logo;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
 
    public function login()
    {
		if (Auth::check()) {
			// The user is logged in...
			return redirect('backend/dashboard');
		}
        $querySistem = null;
        $logo=Logo::find(1);

		$data = array(   
            'querySistem' => $querySistem, 
            'indexPage' => "Login",
            'logo' => $logo
		);
		
        return view('auth.login')->with($data);;
    }
	
    public function login_form(Request $request)
    {
        $rules = [
            'username'   => 'required',
            'password'=> 'required',
            'captcha'=>'required|captcha',
        ];
         $messages = [
            'required'=>"Form tidak boleh kosong",
            'captcha'=>"Captcha tidak sesuai",
        ];
        // $remember = $request->input('remember');
        $validation = Validator::make($request->all(),$rules, $messages);
        if($validation->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validation);
        }

        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) { 
			return redirect('backend/dashboard')->with(['success' => 'Login Sukses. Selamat datang di '.config('app.name')]);
        }else{ 
			return redirect('/')->with(['error' => 'Login gagal. Silahkan cek kembali isian Anda.']); 
        }

    }
	
    public function reloadCaptcha()
    {
        return captcha_img();
    }

    public function logout(Request $request)
	{
        Auth::logout();
		return redirect('/')->with(['error' => 'Logout berhasil. Sampai jumpa kembali.']); 
    }
}
