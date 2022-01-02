<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class StockIn extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "stock_in";
    protected $fillable = ['product_id','brand_id','size_id','expired_date','total','barcode']; 
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
}
