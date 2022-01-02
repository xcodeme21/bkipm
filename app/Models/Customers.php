<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Customers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "customers";
    protected $fillable = ['nama', 'username', 'alamat', 'no_tlp', 'email']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
