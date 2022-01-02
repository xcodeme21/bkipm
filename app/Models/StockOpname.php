<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $table = "stock_opname";
    protected $fillable = ['submitted_by','submit_date','submit_time','approved_by','approved_date','approved_time','status'];
    
    public $timestamps = false;

    public function submit()
    {
    	return $this->hasOne('App\Models\User', 'id', 'submitted_by');
    }

    public function approve()
    {
    	return $this->hasOne('App\Models\User', 'id', 'approved_by');
    }
}
