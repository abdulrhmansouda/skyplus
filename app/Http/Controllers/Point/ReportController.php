<?php

namespace App\Http\Controllers\Point;

use App\Enums\ReportTypeEnum;
use App\Exports\ReportsExport;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $daterange = $request->daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        $all_date = $request->all_date ?? '';

        $point = Auth::user()->point;

        $reports = Report::where('point_id', $point->id);


        if ($all_date !== "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $to = new Carbon($date[2][0]);
                $reports = $reports->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }
        // dd((clone $reports)->pluck('to_him'));
        // $final_commission = (clone $reports)->where('type',ReportTypeEnum::COMMISSION)->pluck('to_him')?->sum() ?? 0;
        // $final_charge_subscriber = (clone $reports)->where('type',ReportTypeEnum::CHARGE_SUBSCRIBER)->pluck('on_him')?->sum() ?? 0;
        // $final_charge_point = (clone $reports)->where('type',ReportTypeEnum::CHARGE_POINT)->pluck('to_him')?->sum() ?? 0;
        $final_commission = (clone $reports)->where('type',ReportTypeEnum::COMMISSION)->pluck('amount')?->sum() ?? 0;
        $final_charge_subscriber = (clone $reports)->where('type',ReportTypeEnum::CHARGE_SUBSCRIBER)->pluck('amount')?->sum() ?? 0;
        $final_charge_point = (clone $reports)->where('type',ReportTypeEnum::CHARGE_POINT)->pluck('amount')?->sum() ?? 0;

        return view('point.pages.reports', [
            'name_point' => $point->name,

            'reports' => $reports->get(),

            'daterange' => $daterange,
            'all_date' => $all_date,

            'from' => isset($from) ? $from->format('d/m/Y') : 'all',
            'to' => isset($to) ? $to->format('d/m/Y') : 'all',
            'final_commission' => $final_commission,
            'final_charge_subscriber' => $final_charge_subscriber,
            'final_charge_point' => $final_charge_point,
        ]);
    }


    public function export(Request $request)
    {

        
        $daterange = $request->_daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        $all_date = $request->all_date ?? '';

        $point = Auth::user()->point;

        $reports = Report::where('point_id', $point->id);


        if ($all_date !== "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $pre = $from->addDays(-1);
                $to = new Carbon($date[2][0]);
                $reports = $reports->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }



        $reports = $reports
            ->orderBy('created_at');

        $first_report = clone ($reports);
        $first_report->first();
        $pre_account = $first_report->first() ? $first_report->first()->pre_account : 0;

        $pre = isset($pre) ? $pre->format('d/m/Y') : 'all';
        $from = isset($from) ? $from->format('d/m/Y') : 'all';
        $to = isset($to) ? $to->format('d/m/Y') : 'all';

        $export = new ReportsExport($reports->get(), $point->name , $pre, $from, $to ,$pre_account);
        return Excel::download($export, "reports.xlsx");
    }
}
