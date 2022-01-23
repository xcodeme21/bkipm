<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Ekspor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "ekspor";
    protected $fillable = ['jenis_ikan_id','tahun','volume_produksi','nilai_produksi']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    
    public function jenisikan()
    {
    	return $this->hasOne('App\Models\JenisIkan', 'id', 'jenis_ikan_id');
    }
}
