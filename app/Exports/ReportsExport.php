<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToArray;

class ReportsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $reports,$name_points,$pre,$from,$to;
    

    public function __construct($reports,$name_points,$pre,$from,$to){
        $this->reports = $reports;
        $this->name_points = $name_points ?? 'الكل';
        $this->pre = $pre;
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        // dd(1);
        $pre_account = 0;
        $col = new Collection([['التقارير' ,'' ,'' ,'' ,'' ,'' ,'']]);
        $col = $col->add(['الحسابات :' ,$this->name_points ,'' ,'' ,'' ,'' ,'']);
        $col = $col->add(['اعتبار من' ,$this->from,'الى' ,$this->to ,'الرصيد السابق' ,$this->pre ,'0']);
        $col = $col->add(['التاريخ' ,'اسم النقطة' ,'البيان' ,'الملاحظة' ,'عليه' ,'له' ,'الرصيد']);
        $col = $col->add(['' ,'' ,'الكل' ,'' ,'' ,'' ,'0']);
        foreach($this->reports as $report){
            $pre_account = $pre_account - $report->to_him + $report->on_him;
            $col = $col->add([$report->created_at,
            $report->point->name,
            $report->report,
            $report->note,
            $report->on_him ? $report->on_him : '0',
            $report->to_him ? $report->to_him : '0',
            $pre_account ? $pre_account : '0',
        ]);
        }
        $col = $col->add(['' ,'','' ,'' ,'الرصيد النهائي' ,$this->to ,$pre_account]);

        // $col = $col->merge($this->subs->get()->toArray());

        return $col;
    }
}
