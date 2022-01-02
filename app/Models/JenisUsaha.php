<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class JenisUsaha extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "jenis_usaha";
    protected $fillable = ['jenis_usaha']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
