<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\StockList;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Size;

class StockListController extends Controller
{
    protected $base = 'stock-list.';

    public function __construct()
    {
        $this->middleware('permission:stock-list-list|stock-list-create|stock-list-edit|stock-list-delete', ['only' => ['index']]);
        $this->middleware('permission:stock-list-create', ['only' => []]);
        $this->middleware('permission:stock-list-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:stock-list-delete', ['only' => ['delete']]);

        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $stocklist=StockList::all();

		$data = array(  
            'indexPage' => "Stock List",
            'stocklist' => $stocklist
		);
        return view($this->base.'index')->with($data);
    }
  
    public function edit($id)
    {
        $rs=StockList::find($id);
        $products=Products::all();
        $brands=Brands::all();
        $size=Size::all();

		$data = array(  
            'indexPage' => "Update Data Stock List",
            'rs' => $rs,
            'products' => $products,
            'brands' => $brands,
            'size' => $size
		);
        return view($this->base.'update')->with($data);
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id');
        
		$update = StockList::whereId($id)->update($request->except('_token'));

        return redirect()->route('stock-list')->with(['success' => 'Data stock list diupdate.']); 
    }

    public function delete($id)
    {
        $id = StockList::find($id);
        $id ->delete();
            
        return redirect()->route('stock-list')->with(['success' => 'Data stock list dihapus.']);
    }
	
    public function getbrand($id)
    {
        $product = Products::where('id', $id)->first();
        $brand = Brands::where('id', $product->brand_id)->first();
        return response()->json($brand);
    }
	
}
