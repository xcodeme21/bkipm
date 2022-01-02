<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\StockOut;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Size;
use App\Models\StockOutTemporary;
use App\Models\StockList;
use App\Models\Customers;
use App\Models\Delivery;
use App\Models\Source;
use App\Models\Orders;
use Illuminate\Support\Str;

class StockOutController extends Controller
{
    protected $base = 'stock-out.';

    public function __construct()
    {
        $this->middleware('permission:stock-out-list|stock-out-create|stock-out-edit|stock-out-delete', ['only' => ['index', 'view']]);
        $this->middleware('permission:stock-out-create', ['only' => ['tambah','tambahtemporary','add','move']]);
        $this->middleware('permission:stock-out-edit', ['only' => []]);
        $this->middleware('permission:stock-out-delete', ['only' => ['delete', 'deletetempo']]);

        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $stockout=StockOut::all();

		$data = array(  
            'indexPage' => "Stock Out",
            'stockout' => $stockout
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
        $customers=Customers::all();
        $delivery=Delivery::all();
        $source=Source::all();
        $ordernumber=strtoupper(Str::random(14));

		$data = array(  
            'indexPage' => "Order Baru",
            'customers' => $customers,
            'delivery' => $delivery,
            'source' => $source,
            'ordernumber' => $ordernumber
		);
        return view($this->base.'add')->with($data);
    }
    
    public function tambahtemporary(Request $request)
    {
        $ordernumber= $request->input('order_number');
        $customer_id= $request->input('customer_id');
        $delivery_id= $request->input('delivery_id');
        $source_id= $request->input('source_id');
        $customers=Customers::find($customer_id);
        $delivery=Delivery::find($delivery_id);
        $source=Source::find($source_id);

        
        $products = DB::table('stock_list')
        ->leftJoin('products','stock_list.product_id','=','products.id')
        ->select('product_id', 'products.nama_produk')
        ->groupBy('product_id','nama_produk')
        ->get();

        $brands=Brands::all();
        $size=Size::all();
        $stockouttempo=StockOutTemporary::where('order_number', $ordernumber)->get();

		$data = array(  
            'indexPage' => "Memasukkan Produk",
            'customers' => $customers,
            'delivery' => $delivery,
            'source' => $source,
            'ordernumber' => $ordernumber,
            'products' => $products,
            'brands' => $brands,
            'size' => $size,
            'stockouttempo' => $stockouttempo,
		);
        return view($this->base.'add2')->with($data);
    }
  
    public function add(Request $request)
    {
        $order_number= $request->input('order_number');
        $customer_id= $request->input('customer_id');
        $product_id= $request->input('product_id');
        $brand_id= $request->input('brand_id');
        $size_id= $request->input('size_id');
        $expired_date= $request->input('expired_date');
        $total= (int) $request->input('total');
        $harga_produk = (int) str_replace('.', '', $request->input('harga_produk'));
        $total_harga_produk= $harga_produk * $total;
        $delivery_id= $request->input('delivery_id');
        $source_id= $request->input('source_id');
        $barcode= $request->input('barcode');
        
        $products=Products::find($product_id);
        $size=Size::find($size_id);

        $cekstock=StockList::where('product_id',$product_id)
        ->where('size_id',$size_id)
        ->where('expired_date',$expired_date)->first();

        if($cekstock == null)
        {
            return redirect()->back()->with(['error' => 'Produk '.$products->nama_produk.' dengan ukuran '.$size->size.' tidak ditemukan di product list.']); 
        }
        else
        {
            if($total > $cekstock->total)
            {
                return redirect()->back()->with(['error' => 'Tidak boleh melebihi stock. Stock saat ini adalah '.$cekstock->total]); 
            }

            $cekstockout=StockOutTemporary::where('order_number', $order_number)
            ->where('product_id',$product_id)
            ->where('size_id',$size_id)
            ->where('expired_date',$expired_date)
            ->first();

            if($cekstockout != null)
            {
                $totalakhir=$cekstockout->total + $total;
                $product=Products::find($product_id);
                $harga_produk=$product->harga;
                $total_harga_produk=$harga_produk * $totalakhir;

                $update=StockOutTemporary::where('order_number', $order_number)
                ->where('product_id',$product_id)
                ->where('size_id',$size_id)
                ->where('expired_date',$expired_date)
                ->update(
                    [
                        'total' => $totalakhir,
                        'harga_produk' => $harga_produk,
                        'total_harga_produk' => $total_harga_produk,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                );
            }
            else
            {
                $data = [
                    'order_number' => $order_number,
                    'customer_id' => $customer_id,
                    'product_id' => $product_id,
                    'brand_id' => $brand_id,
                    'size_id' => $size_id,
                    'expired_date' => $expired_date,
                    'total' => $total,
                    'harga_produk' => $harga_produk,
                    'total_harga_produk' => $total_harga_produk,
                    'delivery_id' => $delivery_id,
                    'source_id' => $source_id,
                    'barcode' => $barcode,
                ];
            
                $insert = StockOutTemporary::create($data);
            }
    
            return redirect()->back()->with(['success' => 'Data Produk ke Temporary ditambahkan.']); 
        }
    }
    
    public function move(Request $request)
    {
        $order_number=$request->input('order_number_move');
        $customer_id=$request->input('customer_id_move');
        $delivery_id=$request->input('delivery_id_move');
        $source_id=$request->input('source_id_move');

        $stockouttempo=StockOutTemporary::where('order_number',$order_number)->get();
        $harga_semua_produk=StockOutTemporary::where('order_number',$order_number)->sum('total_harga_produk');
        $customer=Customers::find($customer_id);

        Orders::create(
            [
                'order_number' => $order_number,
                'customer_id' => $customer_id,
                'no_tlp' => $customer->no_tlp,
                'alamat' => $customer->alamat,
                'delivery_id' => $delivery_id,
                'source_id' => $source_id,
                'harga_semua_produk' => $harga_semua_produk,
                'total_harga' => $harga_semua_produk
            ]
        );

        if(count($stockouttempo) == 0)
        {
            return redirect()->back()->with(['success' => 'Data Stock Temporary kosong.']);  
        }
        else
        {
            foreach($stockouttempo as $sit)
            {
                StockOut::create(
                    [
                        'order_number' => $sit->order_number,
                        'customer_id' => $sit->customer_id,
                        'product_id' => $sit->product_id,
                        'brand_id' => $sit->brand_id,
                        'size_id' => $sit->size_id,
                        'expired_date' => $sit->expired_date,
                        'total' => $sit->total,
                        'harga_produk' => $sit->harga_produk,
                        'total_harga_produk' => $sit->total_harga_produk,
                        'delivery_id' => $sit->delivery_id,
                        'source_id' => $sit->source_id,
                        'barcode' => $sit->barcode
                    ]
                );

                $cek=StockList::where('product_id',$sit->product_id)
                ->where('size_id',$sit->size_id)
                ->where('expired_date',$sit->expired_date)
                ->first();

                $total=$cek->total - $sit->total;

                StockList::where('product_id',$sit->product_id)
                ->where('size_id',$sit->size_id)
                ->where('expired_date',$sit->expired_date)
                ->update(
                    [
                        'expired_date' => $sit->expired_date,
                        'total' => $total
                    ]
                );

                $delete=StockOutTemporary::where('order_number',$order_number)->delete();
            } 

            return redirect()->route('stock-out')->with(['success' => 'Successfully.']); 
        }
    }
  
    public function view($id)
    {
        $rs=StockOut::find($id);
        $products=Products::all();
        $brands=Brands::all();
        $size=Size::all();

		$data = array(  
            'indexPage' => "View Data Stock Out",
            'rs' => $rs,
            'products' => $products,
            'brands' => $brands,
            'size' => $size
		);
        return view($this->base.'view')->with($data);
    }

    public function delete($id)
    {
        $si = StockOut::find($id);
        $stocklist = StockList::where('product_id',$si->product_id)
        ->where('size_id',$si->size_id)
        ->where('expired_date',$si->expired_date)->first();
        $total=$stocklist->total + $si->total;
        
        $update = StockList::where('product_id',$si->product_id)
        ->where('size_id',$si->size_id)
        ->where('expired_date',$si->expired_date)
        ->update(
            [
                'total' => $total
            ]
        );

        $order_number=$si->order_number;


        $id = StockOut::find($id);
        $id ->delete();
        
        $detailorder=Orders::where('order_number', $order_number)->first();

        $updateorder=Orders::where('order_number', $order_number)->update(
            [
                'harga_semua_produk' => StockOut::where('order_number', $order_number)->sum('total_harga_produk'),
                'biaya_admin' => $detailorder->biaya_admin,
                'diskon_voucher' => $detailorder->diskon_voucher,
                'total_harga' => $detailorder->biaya_admin + $detailorder->biaya_admin + StockOut::where('order_number', $order_number)->sum('total_harga_produk'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        if(StockOut::where('order_number', $order_number)->sum('total_harga_produk') == 0)
        {
            $deleteorder = Orders::where('order_number', $order_number)->delete();
        }
            
        return redirect()->route('stock-out')->with(['success' => 'Data Stock Out dihapus.']);
    }
	
    public function getdetailcustomer($id)
    {
        $customers = Customers::where('id', $id)->first();
        return response()->json($customers);
    }

    public function deletetempo($id)
    {
        $id = StockOutTemporary::find($id);
        $id ->delete();
            
        return redirect()->back()->with(['success' => 'Data Stock Out Temporary dihapus.']);
    }
	
    public function getbrand($id)
    {
        $product = Products::where('id', $id)->first();
        $brand = Brands::where('id', $product->brand_id)->first();
        
        $size = DB::table('stock_list')
        ->leftJoin('size','stock_list.size_id','=','size.id')
        ->select('size_id', 'size.size')
        ->where('product_id',$id)
        ->where('stock_list.deleted_at',null)
        ->groupBy('size_id','size')
        ->get();
 

        $brand=[
            'id' => $brand->id,
            'nama_brand' => $brand->nama_brand,
            'harga' => number_format(@$product->harga,0,',','.'),
            'product_id' => $product->id,
            'size' => $size,
        ];
        return response()->json($brand);
    }

    public function getexpireddate($productID, $sizeID)
    {
        $stocklist = StockList::where('product_id', $productID)->where('size_id', $sizeID)->get();

        return response()->json($stocklist);
    }

    public function getbarcode($productID, $sizeID, $expiredDate)
    {
        $stocklist = StockList::where('product_id', $productID)
        ->where('size_id', $sizeID)
        ->where('expired_date', $expiredDate)->first();

        return response()->json($stocklist);
    }
  
    public function addcustomer(Request $request)
    {
		$id = DB::table('customers')->insertGetId([
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'alamat' => $request->input('alamat'),
            'no_tlp' => $request->input('no_tlp'),
            'email' => $request->input('email'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $detailcustomer=Customers::find($id);

        $customers=Customers::all();
        $delivery=Delivery::all();
        $source=Source::all();
        $ordernumber=$request->input('ordernumber');

		$data = array(  
            'indexPage' => "Order Baru",
            'customers' => $customers,
            'delivery' => $delivery,
            'source' => $source,
            'ordernumber' => $ordernumber,
            'detailcustomer' => $detailcustomer
		);
        return view($this->base.'add')->with($data);

    }
}
