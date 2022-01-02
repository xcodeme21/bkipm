<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class StockOut extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "stock_out";
    protected $fillable = ['order_number','customer_id','product_id','brand_id','size_id','expired_date','total','delivery_id','source_id','harga_produk','total_harga_produk','barcode']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];

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

    public function customers()
    {
    	return $this->hasOne('App\Models\Customers', 'id', 'customer_id');
    }

    public function delivery()
    {
    	return $this->hasOne('App\Models\Delivery', 'id', 'delivery_id');
    }

    public function source()
    {
    	return $this->hasOne('App\Models\Source', 'id', 'source_id');
    }
}
