<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB, Hash;
use Yajra\Datatables\Datatables;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;

class UsersController extends Controller
{
    protected $base = 'users.';

    public function __construct()
    {
        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $users=User::all();

		$data = array(  
            'indexPage' => "Users",
            'users' => $users
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
		$data = array(  
            'indexPage' => "Tambah Data Users"
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
        ]);
		
        $input = $request->except('_token');
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);

        return redirect()->route('users')->with(['success' => 'Data user ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $user = User::find($id);

		$data = array(  
            'indexPage' => "Update Data Users",
            'user' => $user
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('users')->with(['success' => 'Data user diupdate.']); 
    }

    public function delete($id)
    {
        $id = User::find($id);
        $id ->delete();
            
        return redirect()->route('users')->with(['success' => 'Data user dihapus.']);
    }
	
}
