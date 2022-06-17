<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\BoxBank;
use App\Models\BoxCash;
use App\Models\Invoice;
use App\Models\Point;
use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $active     = Subscriber::where('status' , 'active')->count();
        $deactive   = Subscriber::where('status' , 'deactive')->count();
        $closed     = Subscriber::where('status' , 'closed')->count();
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

        $count = $count->sum('months');
        $sum = $sum->sum('amount');

        $current_box_cash = BoxCash::all()?->last()?->account ?? 0;
        $current_box_bank = BoxBank::all()?->last()?->account ?? 0;
        $current_debts    = Point::where('account','<',0)->get()->sum('account');


        return view('accountant.pages.home',[
            'active' => $active,
            'deactive' => $deactive,
            'closed' => $closed,

            'current_box_cash' => $current_box_cash,
            'current_box_bank' => $current_box_bank,
            'current_debts'    => $current_debts,
            // 'date' => $date,
            // 'from' => $from,
            // 'to' => $to,
            'daterange' => $daterange,
            'count' => $count,
            'sum' => $sum,
        ]);
    }
}
