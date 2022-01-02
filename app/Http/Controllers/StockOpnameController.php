<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;
use Yajra\Datatables\Datatables;
use App\Models\StockOpname;
use App\Models\StockOpnameList;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Size;
use App\Models\StockList;
use Illuminate\Support\Str;

class StockOpnameController extends Controller
{
    protected $base = 'stock-opname.';

    public function __construct()
    {
        $this->middleware('permission:stock-opname-list|stock-opname-create|stock-opname-edit|stock-opname-delete|stock-opname-approve', ['only' => ['index','detail']]);
        $this->middleware('permission:stock-opname-create', ['only' => ['tambah','add']]);
        $this->middleware('permission:stock-opname-edit', ['only' => []]);
        $this->middleware('permission:stock-opname-delete', ['only' => []]);
        $this->middleware('permission:stock-opname-approve', ['only' => ['approve']]);

        view()->share('base', $this->base);
    }
  
    public function index()
    {
        $stockopname=StockOpname::orderBy('id','DESC')->get();

		$data = array(  
            'indexPage' => "Stock Opname",
            'stockopname' => $stockopname
		);
        return view($this->base.'index')->with($data);
    }
    
    public function tambah()
    {
        $stocklist=StockList::all();

		$data = array(  
            'indexPage' => "Tambah Stock Opname",
            'stocklist' => $stocklist,
		);
        return view($this->base.'add')->with($data);
    }

    public function add(Request $request)
    {
        $stockopname=array(
            'submitted_by' => auth()->user()->id,
            'submit_date' => date('Y-m-d'),
            'submit_time' => date('H:i:s'),
            'status' => 0,
        );  

        $stock_opname_id = StockOpname::create($stockopname)->id;

        $stock_list_id=$request->input('stock_list_id');
        $jumlah_sekarang=$request->input('jumlah_sekarang');

        foreach($stock_list_id as $key => $no)
        {
            $stocklist=StockList::find($no);
            $jmlskrg=$jumlah_sekarang[$key];

            $selisih=$stocklist->total - $jmlskrg;

            if($selisih > 0)
            {
                $selisih = "+". $selisih;
            }
            else if($selisih == 0)
            {
                $selisih = 0;
            }
            else
            {
                $selisih = $selisih;
            }

            $dataSet = [
                        'stock_opname_id'  => $stock_opname_id,
                        'stock_list_id'    => $stocklist->id,
                        'brand_id'       => $stocklist->brand_id,
                        'product_id'       => $stocklist->product_id,
                        'size_id'       => $stocklist->size_id,
                        'jumlah_list'       => $stocklist->total,
                        'jumlah_sekarang'       => $jmlskrg,
                        'selisih'       => $selisih
                    ];

            StockOpnameList::create($dataSet);
        }

        return redirect()->route('stock-opname')->with(['success' => 'Successfully. Mohon menunggu approve dari Admin.']); 
    }

    public function detail($id)
    {
        $stockopname=StockOpname::find($id);
        $stocklist=StockOpnameList::where('stock_opname_id',$id)->get();

		$data = array(  
            'indexPage' => "Detail Stock Opname",
            'stockopname' => $stockopname,
            'stocklist' => $stocklist,
		);
        return view($this->base.'detail')->with($data);
    }


    public function approve(Request $request)
    {
        $id=$request->input('id');

        $stockopnamelist=StockOpnameList::where('stock_opname_id',$id)->get();

        foreach($stockopnamelist as $sol)
        {
            $sl=StockList::find($sol->stock_list_id); 
        
            $updatestock=StockList::where('id',$sol->stock_list_id)->update(
                [
                    'total' => $sol->jumlah_sekarang,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
        }

        StockOpname::where('id', $id)->update(
            [
                'approved_by' => auth()->user()->id,
                'approved_date' => date('Y-m-d'),
                'approved_time' => date('H:i:s'),
                'status' => 1
            ]
        );

        return redirect()->route('stock-opname')->with(['success' => 'Berhasil approve. Terima kasih.']); 
    }

}
