<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdminSubscribersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function collection()
    {
        // $col = new Collection([['اسم المشترك','T_C','ID','رقم المشترك','تاريخ البدء','تاريخ الانتهاء','اسم الباقة','الحالة']]);
        $col = new Collection([Schema::getColumnListing('subscribers')]);
        $col = $col->merge($this->subs->get()->toArray());
        return $col;
    }
}
