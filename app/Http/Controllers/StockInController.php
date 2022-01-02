<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\StockIn;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Size;
use App\Models\StockInTemporary;
use App\Models\StockList;
use Illuminate\Support\Str;

class StockInController extends Controller
{
    protected $base = 'stock-in.';

    public function __construct()
    {
        $this->middleware('permission:stock-in-list|stock-in-create|stock-in-edit|stock-in-delete', ['only' => ['index', 'view']]);
        $this->middleware('permission:stock-in-create', ['only' => ['tambah','add','move']]);
        $this->middleware('permission:stock-in-edit', ['only' => []]);
        $this->middleware('permission:stock-in-delete', ['only' => ['delete', 'deletetempo']]);

        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $stockin=StockIn::all();
        $unique_code=strtoupper(Str::random(14));

		$data = array(  
            'indexPage' => "Stock In",
            'stockin' => $stockin,
            'unique_code' => $unique_code
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah($unique_code)
    {
        $products=Products::all();
        $brands=Brands::all();
        $size=Size::all();
        $stockintempo=StockInTemporary::where('unique_code',$unique_code)->get();

		$data = array(  
            'indexPage' => "Tambah Data Stock In",
            'products' => $products,
            'brands' => $brands,
            'size' => $size,
            'stockintempo' => $stockintempo,
            'unique_code' => $unique_code
		);
        return view($this->base.'add')->with($data);
    }
  
    public function add(Request $request)
    {
        $data=array(
            'unique_code' => $request->input('unique_code'),
            'product_id' => $request->input('product_id'),
            'brand_id' => $request->input('brand_id'),
            'size_id' => $request->input('size_id'),
            'expired_date' => $request->input('expired_date'),
            'total' => $request->input('total'),
            'barcode' => date('Ymd').time()
        );

        $cekstocktemp=StockInTemporary::where('unique_code',$request->input('unique_code'))
        ->where('product_id', $request->input('product_id'))
        ->where('size_id',$request->input('size_id'))
        ->where('expired_date',$request->input('expired_date'))
        ->first();

        if($cekstocktemp == null )
        {
            $insert = StockInTemporary::create($data);
        }
		else
        {
            $update=StockInTemporary::where('unique_code',$request->input('unique_code'))
            ->where('product_id', $request->input('product_id'))
            ->where('size_id',$request->input('size_id'))
            ->where('expired_date',$request->input('expired_date'))
            ->update(
                [
                    'total' => $request->input('total') + $cekstocktemp->total
                ]
            );
        }

        return redirect()->back()->with(['success' => 'Data Stock In ke Temporary ditambahkan.']); 
    }
    
    public function move(Request $request)
    {
        $unique_code=$request->input('unique_code_move');

        $stockintempo=StockInTemporary::where('unique_code',$unique_code)->get();

        if(count($stockintempo) == 0)
        {
            return redirect()->back()->with(['success' => 'Data Stock Temporary kosong.']);  
        }
        else
        {
            foreach($stockintempo as $sit)
            {
                StockIn::create(
                    [
                        'product_id' => $sit->product_id,
                        'brand_id' => $sit->brand_id,
                        'size_id' => $sit->size_id,
                        'expired_date' => $sit->expired_date,
                        'total' => $sit->total,
                        'barcode' => $sit->barcode
                    ]
                );

                $cek=StockList::where('product_id',$sit->product_id)
                ->where('brand_id',$sit->brand_id)
                ->where('size_id',$sit->size_id)
                ->where('expired_date',$sit->expired_date)->first();

                if($cek == null)
                {
                    StockList::create(
                        [
                            'product_id' => $sit->product_id,
                            'brand_id' => $sit->brand_id,
                            'size_id' => $sit->size_id,
                            'expired_date' => $sit->expired_date,
                            'total' => $sit->total,
                            'barcode' => $sit->barcode
                        ]
                    );
                }
                else
                {
                    $total=$cek->total + $sit->total;
                    StockList::where('product_id',$sit->product_id)
                    ->where('brand_id',$sit->brand_id)
                    ->where('size_id',$sit->size_id)
                    ->where('expired_date',$sit->expired_date)->update(
                        [
                            'expired_date' => $sit->expired_date,
                            'total' => $total
                        ]
                    );
                }

                $delete=StockInTemporary::where('unique_code',$unique_code)->delete();
            } 

            return redirect()->route('stock-in')->with(['success' => 'Successfully.']); 
        }
    }
  
    public function view($id)
    {
        $rs=StockIn::find($id);
        $products=Products::all();
        $brands=Brands::all();
        $size=Size::all();

		$data = array(  
            'indexPage' => "View Data Stock In",
            'rs' => $rs,
            'products' => $products,
            'brands' => $brands,
            'size' => $size
		);
        return view($this->base.'view')->with($data);
    }

    public function delete($id)
    {
        $si = StockIn::find($id);
        $stocklist = StockList::where('product_id',$si->product_id)
        ->where('brand_id',$si->brand_id)
        ->where('size_id',$si->size_id)
        ->where('expired_date',$si->expired_date)->first();

        if($stocklist != null)
        {
            $total=$stocklist->total - $si->total;
            
            $update = StockList::where('product_id',$si->product_id)
            ->where('brand_id',$si->brand_id)
            ->where('size_id',$si->size_id)
            ->where('expired_date',$si->expired_date)->update(
                [
                    'total' => $total
                ]
            );

            $id = StockIn::find($id);
            $id ->delete();
        }
        else
        {
            $id = StockIn::find($id);
            $id ->delete();
        }
            
        return redirect()->route('stock-in')->with(['success' => 'Data Stock In dihapus.']);
    }
	
    public function getbrand($id)
    {
        $product = Products::where('id', $id)->first();
        $brand = Brands::where('id', $product->brand_id)->first();
        return response()->json($brand);
    }

    public function deletetempo($id)
    {
        $id = StockInTemporary::find($id);
        $id ->delete();
            
        return redirect()->back()->with(['success' => 'Data Stock In Temporary dihapus.']);
    }

    public function scan(Request $request)
    {
        $barcode=$request->input('barcode');

        $stocklist=StockList::leftJoin('products','stock_list.product_id','=','products.id')
        ->leftJoin('brands','stock_list.brand_id','=','brands.id')
        ->select('stock_list.*','products.nama_produk','products.harga','brands.nama_brand')
        ->where('barcode',$barcode)->first();

        if($stocklist == null)
        {
            $data=array(
                'data' => null,
                'status' => 400
            );

            return response()->json($data);
        }
        else
        {
            $data=array(
                'data' => $stocklist,
                'status' => 200
            );

            return response()->json($data);
        }
    }
}
