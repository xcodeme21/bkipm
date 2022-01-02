<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "products";
    protected $fillable = ['nama_produk', 'harga', 'brand_id']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
