<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class JenisIkan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "jenis_ikan";
    protected $fillable = ['jenis_ikan','harga']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
