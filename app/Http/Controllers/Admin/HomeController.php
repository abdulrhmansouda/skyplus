<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = Subscriber::where('status' , 'active')->count();
        $deactive = Subscriber::where('status' , 'deactive')->count();
        $closed = Subscriber::where('status' , 'closed')->count();
        // start daterange
        $daterange = $request->daterange ?? now()->format('m/d/Y') . " - " . now()->format('m/d/Y');

        preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
        if ($date[1]) {
            $from = new Carbon($date[1][0]);
            // $pre = $from->addDays(-1);
            $to = new Carbon($date[2][0]);
        }

        $count = Invoice::whereDate('created_at', '>=', $from)
        ->whereDate('created_at', '<=', $to);
        // end daterange


        $sum = clone $count;

        $count = $count->sum('month');
        $sum = $sum->sum('amount');


        return view('admin.pages.home',[
            'active' => $active,
            'deactive' => $deactive,
            'closed' => $closed,
            // 'date' => $date,
            // 'from' => $from,
            // 'to' => $to,
            'daterange' => $daterange,
            'count' => $count,
            'sum' => $sum,
        ]);
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
