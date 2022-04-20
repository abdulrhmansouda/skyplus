<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

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


        $points = $request->points;


        $reports = Report::select('*');
        if ($points)
            $reports = Report::whereIn('point_id', $points);


        preg_match_all("/([^-]*) - (.*)/", $request->daterange, $date);
        if ($date[1]) {
            $from = new Carbon($date[1][0]);
            $pre = $from->addDays(-1);
            $to = new Carbon($date[2][0]);
            $reports = $reports->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to);
        }

        $reports = $reports->orderBy('point_id')->orderBy('created_at');

        return view('admin.pages.reports', [
            'points' => Point::select(['id', 'name'])->get(),
            'reports' => $reports->paginate(10)->appends($request->all()),
            'daterange' => $request->daterange,

            'pre' => isset($pre) ? $pre->format('d/m/Y') : 'all',
            'from' => isset($from) ? $from->format('d/m/Y') : 'all',
            'to' => isset($to) ? $to->format('d/m/Y') : 'all',
        ]);
    }

    public function search()
    {
        dd(request()->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
