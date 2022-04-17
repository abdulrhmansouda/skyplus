<?php

namespace App\Exports;

use Illuminate\Support\Collection;
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
        $col = new Collection([['اسم المشترك','T_C','ID','رقم المشترك','تاريخ البدء','تاريخ الانتهاء','اسم الباقة','الحالة']]);
        foreach($this->subs->get() as $sub){
            $col->add([$sub->name,$sub->t_c,$sub->sub_id,$sub->subscriber_number,$sub->start_package,$sub->end_package,$sub->package->name,$sub->state]);
        }

        return $col;
    }
}
