<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportsExport;
use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        $points = (in_array("0", $request->points ?? ["0"])) ? ["0"] : $request->points;

        $reports = Report::select('*');
        if (!in_array("0", $points)) {
            $reports = Report::whereIn('point_id', $points);

            // collect the name of whole points
            $name_points = '';
            $_points = Point::whereIn('id', $points)->get();
            foreach ($_points as $point) {
                $name_points = "$name_points , $point->name";
            }
        }

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


        
        return view('admin.pages.reports', [
            'points' => Point::select(['id', 'name'])->get(),
            '_points' => $points ?? [],
            'name_points' => $name_points ?? '',

            'reports' => $reports->get(),
            'daterange' => $daterange,
            'all_date' => $all_date,

            'pre_account' => 0,

            'pre' => isset($pre) ? $pre->format('d/m/Y') : 'all',
            'from' => isset($from) ? $from->format('d/m/Y') : 'all',
            'to' => isset($to) ? $to->format('d/m/Y') : 'all',
        ]);
    }


    public function admin_export(Request $request)
    {

        // dd($request->all());
        $daterange = $request->_daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        $all_date = $request->all_date ?? '';

        $points = $request->points;
        $points = unserialize(base64_decode($points));
        $points = (in_array("0", $points ?? ["0"])) ? ["0"] : $points;

        $reports = Report::select('*');
        if (!in_array("0", $points)) {
            $reports = Report::whereIn('point_id', $points);

            // collect the name of whole points
            $name_points = '';
            $_points = Point::whereIn('id', $points)->get();
            foreach ($_points as $point) {
                $name_points = "$name_points , $point->name";
            }
        }

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

        $pre = isset($pre) ? $pre->format('d/m/Y') : 'all';
        $from = isset($from) ? $from->format('d/m/Y') : 'all';
        $to = isset($to) ? $to->format('d/m/Y') : 'all';

        $export = new ReportsExport($reports->get(), $name_points ?? '', $pre, $from, $to,0);
        return Excel::download($export, "reports.xlsx");
    }
}
