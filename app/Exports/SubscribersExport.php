<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscribersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $subs;

    public function __construct($subs){
        $this->subs = $subs;
    }

    public function collection()
    {
        // return $this->subs->get();
        // $col = new Collection([['اسم المشترك','T_C','ID','رقم المشترك','تاريخ البدء','تاريخ الانتهاء','اسم الباقة','الحالة']]);
        $col = new Collection([Schema::getColumnListing('subscribers')]);
        // foreach($this->subs->get() as $sub){
        //     $col->add([$sub->name,$sub->t_c,$sub->sub_id,$sub->subscriber_number,$sub->start_package,$sub->end_package,$sub->package->name,$sub->state]);
        // }
        $col = $col->merge($this->subs->get()->toArray());
            // dd($col);
        return $col;
    }
}
