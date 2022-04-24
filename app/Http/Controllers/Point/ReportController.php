<?php

namespace App\Http\Controllers\Point;

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

        return view('point.pages.reports', [
            'name_points' => $point->name,
            'pre_account' => $pre_account,

            'reports' => $reports->get(),

            'daterange' => $daterange,
            'all_date' => $all_date,


            'pre' => isset($pre) ? $pre->format('d/m/Y') : 'all',
            'from' => isset($from) ? $from->format('d/m/Y') : 'all',
            'to' => isset($to) ? $to->format('d/m/Y') : 'all',
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


        //////////////////////

        // // dd($request->all());
        // $daterange = $request->_daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        // $all_date = $request->all_date ?? '';

        // $points = $request->points;
        // $points = unserialize(base64_decode($points));
        // $points = (in_array("0", $points ?? ["0"])) ? ["0"] : $points;

        // $reports = Report::select('*');
        // if (!in_array("0", $points)) {
        //     $reports = Report::whereIn('point_id', $points);

        //     // collect the name of whole points
        //     $name_points = '';
        //     $_points = Point::whereIn('id', $points)->get();
        //     foreach ($_points as $point) {
        //         $name_points = "$name_points , $point->name";
        //     }
        // }

        // if ($all_date !== "true") {
        //     preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
        //     if ($date[1]) {
        //         $from = new Carbon($date[1][0]);
        //         $pre = $from->addDays(-1);
        //         $to = new Carbon($date[2][0]);
        //         $reports = $reports->whereDate('created_at', '>=', $from)
        //             ->whereDate('created_at', '<=', $to);
        //     }
        // }

        // $reports = $reports
        //     ->orderBy('created_at');

        $pre = isset($pre) ? $pre->format('d/m/Y') : 'all';
        $from = isset($from) ? $from->format('d/m/Y') : 'all';
        $to = isset($to) ? $to->format('d/m/Y') : 'all';

        $export = new ReportsExport($reports->get(), $point->name , $pre, $from, $to ,$pre_account);
        return Excel::download($export, "reports.xlsx");
    }
}
