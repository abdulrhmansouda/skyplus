<?php

namespace App\Exports;

use App\Enums\ReportTypeEnum;
use App\Models\Point;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdminReportsExport implements FromCollection
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
        // dd($this->request->all());
        $all_date = $this->request->all_date ?? '';

        $points = $this->request->points;
        $points = unserialize(base64_decode($points));
        $points = (in_array("0", $points ?? ["0"])) ? ["0"] : $points;

        $daterange = $this->request->daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        $report_type = $this->request->report_type;

        $reports = new Report;

        if (!in_array("0", $points)) {
            $reports = $reports->whereIn('point_id', $points);

            // collect the name of whole points
            $name_points = '';
            $_points = Point::whereIn('id', $points)->get();
            foreach ($_points as $point) {
                $name_points = "$name_points , $point->name";
            }
        }

        if (isset($report_type)) {
            $reports = $reports->where('type', intval($report_type));
        }


        if ($all_date != "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $to = new Carbon($date[2][0]);
                $reports = $reports->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }

        $from = isset($from) ? $from->format('d/m/Y') : (clone $reports)->get()->first()->created_at->format('d/m/Y');
        $to   = isset($to) ? $to->format('d/m/Y') : (clone $reports)->get()->last()->created_at->format('d/m/Y');

        $final_commission = (clone $reports)->where('type', ReportTypeEnum::COMMISSION->value)->pluck('amount')?->sum() ?? 0;
        $final_charge_subscriber = -1 * (clone $reports)->where('type', ReportTypeEnum::CHARGE_SUBSCRIBER->value)->pluck('amount')?->sum() ?? 0;
        $final_charge_point = (clone $reports)->where('type', ReportTypeEnum::CHARGE_POINT->value)->pluck('amount')?->sum() ?? 0;

        $reports = $reports->get();

        //////////////////////////

        $col = new Collection([['التقارير']]);
        $col = $col->add(['الحسابات :', $this->name_points ?? 'الكل']);
        $col = $col->add(['اعتبار من', $this->from ?? 'كل التاريخ', 'الى', $this->to ?? 'كل التاريخ']);
        $col = $col->add(['التاريخ', 'اسم النقطة', 'مشرف العملية', 'اسم المشترك', 'نوع البيان', 'البيان', 'الملاحظة', 'المبلغ', 'الرصيد']);
        $col = $col->add(['', '', '', '', '', '', '', '', "{$reports?->first()->pre_account}" ?? 0]);
        foreach ($reports as $report) {
            $col = $col->add([
                $report->created_at,
                $report->point->name,
                $report->operationSupervisor(),
                $report?->subscriber?->sub_username ?? '_',
                $report->reportType(),
                $report->report,
                $report->note,
                "{$report->amount}",
                "{$report->account}",
            ]);
        }
        $col = $col->add(['']);
        $col = $col->add(['مجموع شحن الأرصدة', "{$final_charge_point}",
         'مجموع تسديد الفواتير', "{$final_charge_subscriber}",
          'مجموع العمولات', "{$final_commission}",]);

        return $col;
    }
}
