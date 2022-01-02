<?php

namespace App\Exports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersByDateExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $from;
    protected $to;

    function __construct($from, $to) {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        return Orders::whereBetween('created_at', [$this->from, $this->to])->orderBy('id', 'DESC')->get();
    }
}
