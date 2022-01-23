<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class EksporFrekuensi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "ekspor_frekuensi";
    protected $fillable = ['ekspor_id','frekuensi','tahun']; 
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function ekspor()
    {
    	return $this->hasOne('App\Models\Ekspor', 'id', 'ekspor_id');
    }
}
