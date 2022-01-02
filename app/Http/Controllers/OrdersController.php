<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\Orders;
use App\Models\StockOut;
use App\Models\StockList;
use App\Models\Delivery;
use App\Models\Source;
use App\Models\Products;
use App\Models\Size;
use App\Models\Customers;
use App\Models\Brands;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use App\Exports\OrdersByDateExport;

class OrdersController extends Controller
{
    protected $base = 'orders.';

    public function __construct()
    {
        $this->middleware('permission:orders-list|orders-create|orders-edit|orders-delete', ['only' => ['index', 'view']]);
        $this->middleware('permission:orders-create', ['only' => []]);
        $this->middleware('permission:orders-edit', ['only' => ['edit','update','finish', 'updateproduct']]);
        $this->middleware('permission:orders-delete', ['only' => ['deleteproduct']]);

        view()->share('base', $this->base);
    }
  
    public function index(Request $request)
    {
        $from=$request->input('from');
        $to=$request->input('to');

        if($from == null && $to == null)
        {
            $orders=Orders::orderBy('id', 'DESC')->get();

            $data = array(  
                'indexPage' => "Orders",
                'orders' => $orders
            );
        }
        else
        {
            $orders=Orders::whereBetween('created_at', [$from, $to])->orderBy('id', 'DESC')->get();
            
            $data = array(  
                'indexPage' => "Orders",
                'orders' => $orders,
                'from' => $from,
                'to' => $to
            );
        }
        
        return view($this->base.'index')->with($data);
    }
    
    public function export() 
    {
        return Excel::download(new OrdersExport, 'EXPORT-ORDERS-ALL-'.date('YmdHis').'.xlsx');
    }
    
    public function exportbydates($from, $to) 
    {
        return Excel::download(new OrdersByDateExport($from, $to), 'EXPORT-ORDERS-FROM-'.$from.'-TO-'.$to.'.xlsx');
    }

    public function view($id)
    {   
        $detailorder=Orders::find($id);
        $ordercustomers=Customers::find($detailorder->customer_id);
        $orderdelivery=Delivery::find($detailorder->delivery_id);
        $ordersource=Source::find($detailorder->source_id);
        $ordernumber =$detailorder->order_number;
        $stockout=StockOut::where('order_number', $detailorder->order_number)->get();
        $delivery=Delivery::all();
        $source=Source::all();
        $products = DB::table('stock_list')
        ->leftJoin('products','stock_list.product_id','=','products.id')
        ->select('product_id', 'products.nama_produk')
        ->groupBy('product_id','nama_produk')
        ->get();

        $size=Size::all();
        $totalsum=StockOut::where('order_number', $detailorder->order_number)->sum('total_harga_produk');
        
        $data = array(  
            'indexPage' => "Detail Order",
            'detailorder' => $detailorder,
            'stockout' => $stockout,
            'delivery' => $delivery,
            'source' => $source,
            'products' => $products,
            'size' => $size,
            'totalsum' => $totalsum,
            'ordercustomers' => $ordercustomers,
            'orderdelivery' => $orderdelivery,
            'ordersource' => $ordersource,
            'ordernumber' => $ordernumber
        );

        return view($this->base.'view')->with($data);
    }
  
    public function finish(Request $request)
    {
        $id=$request->input('id');
        $biaya_admin= (int) str_replace('.', '', $request->input('biaya_admin'));
        $diskon_voucher= (int) str_replace('.', '', $request->input('diskon_voucher'));
        $order=Orders::find($id);
        $harga_semua_produk=$order->harga_semua_produk;
        $total_harga=$harga_semua_produk - ($biaya_admin + $diskon_voucher);

		Orders::where('id',$id)->update(
            [
                'biaya_admin' => $biaya_admin,
                'diskon_voucher' => $diskon_voucher,
                'total_harga' => $total_harga,
                'status' => 1
            ]
        );

        return redirect()->route('orders')->with(['success' => 'Finish successfully.']); 
    }
  
    public function update(Request $request)
    {
        $id=$request->input('id_edit');
        $no_tlp=$request->input('no_tlp');
        $alamat=$request->input('alamat');
        $delivery_id=$request->input('delivery_id');
        $source_id=$request->input('source_id');
        $harga_semua_produk= (int) str_replace('.', '', $request->input('harga_semua_produk'));
        $biaya_admin= (int) str_replace('.', '', $request->input('biaya_admin'));
        $diskon_voucher= (int) str_replace('.', '', $request->input('diskon_voucher'));
        $total_harga= (int) str_replace('.', '', $request->input('total_harga'));

		Orders::where('id',$id)->update(
            [
                'no_tlp' => $no_tlp,
                'alamat' => $alamat,
                'delivery_id' => $delivery_id,
                'source_id' => $source_id,
                'harga_semua_produk' => $harga_semua_produk,
                'biaya_admin' => $biaya_admin,
                'diskon_voucher' => $diskon_voucher,
                'total_harga' => $total_harga
            ]
        );

        return redirect()->back()->with(['success' => 'Update Order Berhasil.']); 
    }

    public function deleteproduct($id)
    {
        $stock=StockOut::find($id); 
        $order_number=$stock->order_number;
        $total_harga_produk=$stock->total_harga_produk;

        $orders=Orders::where('order_number',$order_number)->first();
        $harga_semua_produk=$orders->harga_semua_produk;
        $total_harga=$orders->total_harga;

        Orders::where('order_number',$order_number)->update(
            [
                'harga_semua_produk' => $harga_semua_produk - $total_harga_produk,
                'total_harga' => $total_harga - $total_harga_produk,
            ]
        );

        $stocklist=StockList::where('product_id',$stock->product_id)
        ->where('size_id',$stock->size_id)
        ->where('expired_date',$stock->expired_date)
        ->first();

        StockList::where('product_id',$stock->product_id)
        ->where('size_id',$stock->size_id)
        ->where('expired_date',$stock->expired_date)
        ->update(
            [
                'total' => $stocklist->total + $stock->total,
            ]
        );

        $delete=StockOut::find($id);
        $delete->delete(); 

        return redirect()->back()->with(['success' => 'Delete product order berhasil']); 
    }

    public function updateproduct(Request $request)
    {
        $order_number=$request->input('order_number');
        $product_id=$request->input('product_id');
        $size_id=$request->input('size_id');
        $expired_date=$request->input('expired_date');
        $total=$request->input('total');
        
        $cektransaksi=StockOut::where('order_number', $order_number)
        ->where('product_id', $product_id)
        ->where('size_id',$size_id)
        ->where('expired_date',$expired_date)
        ->first();

        $total_transaksi=$cektransaksi->total;
        if($total > $total_transaksi)
        {
            $hasiltotal= $total - $total_transaksi;
        }
        else
        {
            $hasiltotal= $total_transaksi - $total;   
        }

        $cekstock=StockList::where('product_id',$product_id)
        ->where('size_id',$size_id)
        ->where('expired_date',$expired_date)
        ->first();

        if($cekstock == null)
        {
            return redirect()->back()->with(['error' => 'Produk '.$products->nama_produk.' dengan ukuran '.$size->size.' tidak ditemukan di product list.']); 
        }
        else
        {
            if($hasiltotal > $cekstock->total)
            {
                return redirect()->back()->with(['error' => 'Tidak boleh melebihi stock. Stock saat ini adalah '.$cekstock->total]); 
            }
            $total_harga_produk=$cektransaksi->products->harga * $total;

            $updatetransaksi=StockOut::where('order_number', $order_number)
            ->where('product_id', $product_id)
            ->where('size_id',$size_id)
            ->where('expired_date',$expired_date)
            ->update(
                [
                    'size_id' => $size_id,
                    'expired_date' => $expired_date,
                    'total' => $total,
                    'total_harga_produk' => $total_harga_produk,
                ]
            );

            if($total > $total_transaksi)
            {
                $hasiltotal= $total - $total_transaksi;
                $totalstock=$cekstock->total - $hasiltotal;
            }
            else
            {
                $hasiltotal= $total_transaksi - $total;  
                $totalstock=$cekstock->total + $hasiltotal; 
            }
            $updatestocklist=StockList::where('product_id',$product_id)
            ->where('size_id',$size_id)
            ->where('expired_date',$expired_date)
            ->update(
                [
                    'total' => $totalstock,               
                ]
            );
    
            return redirect()->back()->with(['success' => 'Update product order berhasil.']); 
        }
    }

    public function delete ($order_number)
    {
        $stockout=StockOut::where('order_number',$order_number)->get();
        
        foreach($stockout as $so)
        {
            $total = $so->total;
            $stocklist=StockList::where('product_id',$so->product_id)
            ->where('brand_id',$so->brand_id)
            ->where('size_id',$so->size_id)
            ->where('expired_date',$so->expired_date)
            ->first();

            $updatestocklist=StockList::where('product_id',$so->product_id)
            ->where('brand_id',$so->brand_id)
            ->where('size_id',$so->size_id)
            ->where('expired_date',$so->expired_date)
            ->update(
                [
                    'total' => $stocklist->total + $total,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );

            $deleteorders=Orders::where('order_number',$order_number)->delete();
            $deletestockout=StockOut::where('order_number',$order_number)->delete();
    
            return redirect()->route('orders')->with(['success' => 'Order berhasil dihapus.']); 

        }
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

    public function add(Request $request)
    {
        $order_number=$request->input('order_number');
        $customer_id=$request->input('customer_id');
        $delivery_id=$request->input('delivery_id');
        $source_id=$request->input('source_id');
        $product_id=$request->input('product_id');
        $brand_id=$request->input('brand_id');
        $size_id=$request->input('size_id');
        $expired_date=$request->input('expired_date');
        $total=$request->input('total');
        $barcode=$request->input('barcode');
        
        $cekstockout=StockOut::where('order_number', $order_number)
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

            $update=StockOut::where('order_number', $order_number)
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
            $product=Products::find($product_id);
            $harga_produk=$product->harga;
            $total_harga_produk=$harga_produk * $total;

            $insert=StockOut::create(
                [
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
                    'barcode' => $barcode
                ]
            );
        }

        $detailstocklist=StockList::where('product_id',$product_id)
        ->where('size_id',$size_id)
        ->where('expired_date',$expired_date)
        ->first();

        $updatestocklist=StockList::where('product_id',$product_id)
        ->where('size_id',$size_id)
        ->where('expired_date',$expired_date)
        ->update(
            [
                'total' => $detailstocklist->total - $total,
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );



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

        return redirect()->back()->with(['success' => 'Order berhasil ditambahkan.']);
    }

    public function label($id)
    {
        $order=Orders::find($id);
        $items=StockOut::where('order_number',$order->order_number)->get();

        $data=array(
            'order' => $order,
            'items' => $items
        );

        return view($this->base.'label')->with($data);
    }

}
