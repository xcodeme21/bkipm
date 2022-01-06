<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class PpProvinsi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "pp_provinsi";
    protected $fillable = ['jenis_usaha_id','provinsi_id','jenis_ikan_id','tahun','volume_produksi','nilai_produksi']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function jenisusaha()
    {
    	return $this->hasOne('App\Models\JenisUsaha', 'id', 'jenis_usaha_id');
    }

    public function provinsi()
    {
    	return $this->hasOne('App\Models\Provinsi', 'id', 'provinsi_id');
    }

    public function jenisikan()
    {
    	return $this->hasOne('App\Models\JenisIkan', 'id', 'jenis_ikan_id');
    }
}
