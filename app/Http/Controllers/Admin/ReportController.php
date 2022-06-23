<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReportTypeEnum;
use App\Exports\AdminReportsExport;
use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use Spatie\QueryBuilder\QueryBuilder;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $all_date = $request->all_date ?? '';

        $points = (in_array("0", $request->points ?? ["0"])) ? ["0"] : $request->points;

        $daterange = $request->daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        $report_type = $request->report_type;

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
            // dd($reports->toSql());
        }


        if ($all_date !== "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $to = new Carbon($date[2][0]);
                $reports = $reports->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        } else {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $to = new Carbon($date[2][0]);
            }
        }

        $reports = $reports
            ->orderBy('created_at');

        $from = $from->format('d/m/Y');
        $to   =  $to->format('d/m/Y');

        $final_commission = (clone $reports)->where('type', ReportTypeEnum::COMMISSION->value)->pluck('amount')?->sum() ?? 0;
        $final_charge_subscriber = -1 * (clone $reports)->where('type', ReportTypeEnum::CHARGE_SUBSCRIBER->value)->pluck('amount')?->sum() ?? 0;
        $final_charge_point = (clone $reports)->where('type', ReportTypeEnum::CHARGE_POINT->value)->pluck('amount')?->sum() ?? 0;

        return view('admin.pages.reports', [
            'points' => Point::select(['id', 'name'])->get(),
            '_points' => $points ?? [],
            'name_points' => $name_points ?? '',

            'reports' => $reports->get(),
            'report_type' => $report_type,
            'daterange' => $daterange,
            'all_date' => $all_date,

            'from' => $from,
            'to' => $to,
            'final_commission' => $final_commission,
            'final_charge_subscriber' => $final_charge_subscriber,
            'final_charge_point' => $final_charge_point,
        ]);
    }

    public function export(Request $request)
    {
        $export = new AdminReportsExport($request);

        $now    = now()->format('Y_m_d');
        return Excel::download($export, "reports_$now.xlsx");
    }
}
