<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpnameList extends Model
{
    use HasFactory;

    protected $table = "stock_opname_list";
    protected $fillable = ['stock_opname_id','stock_list_id','brand_id','product_id','size_id','jumlah_list','jumlah_sekarang','selisih'];
    public $timestamps = true;
    
    public function stockopname()
    {
    	return $this->hasOne('App\Models\StockOpname', 'id', 'stock_opname_id');
    }

    public function products()
    {
    	return $this->hasOne('App\Models\Products', 'id', 'product_id');
    }

    public function brands()
    {
    	return $this->hasOne('App\Models\Brands', 'id', 'brand_id');
    }

    public function size()
    {
    	return $this->hasOne('App\Models\Size', 'id', 'size_id');
    }

    public function stocklist()
    {
    	return $this->hasOne('App\Models\StockList', 'id', 'stock_list_id');
    }
}
