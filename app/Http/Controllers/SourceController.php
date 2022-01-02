<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Source;
use App\Models\Orders;

class SourceController extends Controller
{
    protected $base = 'source.';

    public function __construct()
    {
        $this->middleware('permission:source-list|source-create|source-edit|source-delete', ['only' => ['index']]);
        $this->middleware('permission:source-create', ['only' => ['tambah','add']]);
        $this->middleware('permission:source-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:source-delete', ['only' => ['delete']]);

        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $source=Source::all();

		$data = array(  
            'indexPage' => "Source",
            'source' => $source
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
		$data = array(  
            'indexPage' => "Tambah Data Source",
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
		$insert = Source::create($request->except('_token'));

        return redirect()->route('source')->with(['success' => 'Data source ditambahkan.']); 
    }
  
    public function edit($id)
    {
        $rs=Source::find($id);

		$data = array(  
            'indexPage' => "Update Data Source",
            'rs' => $rs
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');
        
		$update = Source::whereId($id)->update($request->except('_token'));

        return redirect()->route('source')->with(['success' => 'Data source diupdate.']); 
    }

    public function delete($id)
    {
        $order=Orders::where('source_id', $id)->count();
        if($order != 0)
        {
            return redirect()->route('source')->with(['error' => 'Data source tidak dapat dihapus karena terdapat di orders']);
        }
        else
        {
            $id = Source::find($id);
            $id ->delete();

            return redirect()->route('source')->with(['success' => 'Data source dihapus.']);
        }
    }
	
}
