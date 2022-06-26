<?php

namespace App\Exports;

use App\Enums\ReportTypeEnum;
use App\Models\Point;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class PointReportExport implements FromCollection
{
    /**
     * 
     * @return \Illuminate\Support\Collection
     */
    private $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $daterange = $this->request->daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        $all_date = $this->request->all_date ?? '';

        $point = Auth::user()->point;

        $reports = Report::where('point_id', $point->id);


        if ($all_date != "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $to = new Carbon($date[2][0]);
                $reports = $reports->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }

        $final_commission = (clone $reports)->where('type', ReportTypeEnum::COMMISSION->value)->pluck('amount')?->sum() ?? 0;
        $final_charge_subscriber = (clone $reports)->where('type', ReportTypeEnum::CHARGE_SUBSCRIBER->value)->pluck('amount')?->sum() ?? 0;
        $final_charge_point = (clone $reports)->where('type', ReportTypeEnum::CHARGE_POINT->value)->pluck('amount')?->sum() ?? 0;
        
        $from = isset($from) ? $from->format('d/m/Y') : (clone $reports)->get()->first()->created_at->format('d/m/Y');
        $to   = isset($to) ? $to->format('d/m/Y') : (clone $reports)->get()->last()->created_at->format('d/m/Y');

        $reports = $reports->get();

        //////////////////////////

        $col = new Collection([['التقارير']]);
        $col = $col->add(['الحساب :', $point->name]);
        $col = $col->add(['اعتبار من', $from ?? 'كل التاريخ', 'الى', $to ?? 'كل التاريخ']);
        $col = $col->add(['التاريخ', 'اسم النقطة', 'البيان', 'الملاحظة', 'المبلغ', 'الرصيد']);
        $col = $col->add(['', '', '', '', '', "{$reports?->first()->pre_account}" ?? '0']);
        // dd($reports);
        foreach ($reports as $report) {
            $col = $col->add([
                $report->created_at,
                $point->name,
                $report->report,
                $report->note,
                "{$report->amount}",
                "{$report->account}",
            ]);
        }
        $col = $col->add(['']);
        $col = $col->add([
            'مجموع شحوناتي للرصيد', "{$final_charge_point}",
            'مجموع تسديد الفواتير', "{$final_charge_subscriber}",
            'مجموع العمولات', "{$final_commission}",
        ]);

        return $col;
    }
}
