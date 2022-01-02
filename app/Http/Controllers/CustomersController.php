<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Customers;

class CustomersController extends Controller
{
    protected $base = 'customers.';

    public function __construct()
    {
        $this->middleware('permission:customers-list|customers-create|customers-edit|customers-delete', ['only' => ['index']]);
        $this->middleware('permission:customers-create', ['only' => ['tambah','add']]);
        $this->middleware('permission:customers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customers-delete', ['only' => ['delete']]);

        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $customers=Customers::all();

		$data = array(  
            'indexPage' => "Customers",
            'customers' => $customers
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
		$data = array(  
            'indexPage' => "Tambah Data Customers",
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
		$insert = Customers::create($request->except('_token'));

        return redirect()->route('customers')->with(['success' => 'Data customers ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=Customers::find($id);

		$data = array(  
            'indexPage' => "Update Data Customers",
            'rs' => $rs
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');
        
		$update = Customers::whereId($id)->update($request->except('_token'));

        return redirect()->route('customers')->with(['success' => 'Data customers diupdate.']); 
    }

    public function delete($id)
    {
        $id = Customers::find($id);
        $id ->delete();
            
        return redirect()->route('customers')->with(['success' => 'Data customers dihapus.']);
    }
	
}
