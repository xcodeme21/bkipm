<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class ImporFrekuensi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "impor_frekuensi";
    protected $fillable = ['impor_id','frekuensi','tahun']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function impor()
    {
    	return $this->hasOne('App\Models\Impor', 'id', 'impor_id');
    }
}
