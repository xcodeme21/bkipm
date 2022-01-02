<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Delivery;
use App\Models\Orders;

class DeliveryController extends Controller
{
    protected $base = 'delivery.';

    public function __construct()
    {
        $this->middleware('permission:delivery-list|delivery-create|delivery-edit|delivery-delete', ['only' => ['index']]);
        $this->middleware('permission:delivery-create', ['only' => ['tambah','add']]);
        $this->middleware('permission:delivery-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:delivery-delete', ['only' => ['delete']]);

        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $delivery=Delivery::all();

		$data = array(  
            'indexPage' => "Delivery",
            'delivery' => $delivery
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
		$data = array(  
            'indexPage' => "Tambah Data Delivery",
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
		$insert = Delivery::create($request->except('_token'));

        return redirect()->route('delivery')->with(['success' => 'Data delivery ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=Delivery::find($id);

		$data = array(  
            'indexPage' => "Update Data Delivery",
            'rs' => $rs
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');
        
		$update = Delivery::whereId($id)->update($request->except('_token'));

        return redirect()->route('delivery')->with(['success' => 'Data delivery diupdate.']); 
    }

    public function delete($id)
    {
        $order=Orders::where('delivery_id', $id)->count();
        if($order != 0)
        {
            return redirect()->route('delivery')->with(['error' => 'Data delivery tidak dapat dihapus karena terdapat di orders']);
        }
        else
        {
            $id = Delivery::find($id);
            $id ->delete();

            return redirect()->route('delivery')->with(['success' => 'Data delivery dihapus.']);
        }
    }
	
}
