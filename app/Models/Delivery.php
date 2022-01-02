<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Delivery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "delivery";
    protected $fillable = ['delivery']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
