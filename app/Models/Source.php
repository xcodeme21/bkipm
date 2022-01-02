<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Source extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "source";
    protected $fillable = ['source']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
