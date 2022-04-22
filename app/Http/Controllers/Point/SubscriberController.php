<?php

namespace App\Http\Controllers\Point;

use App\Http\Controllers\Controller;
use App\Http\Requests\Point\ChargeSubscriberRequest;
use App\Models\Report;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $s = $request->s ?? '';

        $subs = Subscriber::where('t_c', "$s")
            ->orWhere('subscriber_number', "$s")
            ->orWhere('phone', "$s");

            $reports = Report::where('point_id',Auth::user()->point->id)
            
                            ->whereDate('created_at', now()->format('Y-m-d'))->get();
            // dd($reports);

        return view('point.pages.subscribers', [
            'subs' => $subs->get(),
            'reports' => $reports,
            // 'packages' => Package::all(),
            'search' => $s,
        ]);
    }


    public function charge(ChargeSubscriberRequest $request, $id)
    {
        
        // dd($request->all());
        // dd(Auth::user()->username);
        // dd($id);
        $month = $request->month;
        $pay = $request->pay;

        $sub = Subscriber::findOrFail($id);
        $package = $sub->package;
        $point = Auth::user()->point;
        // dd($pay === 'true');
        if ($pay === 'true') {
            $amount = $month * $package->price;
            if ($amount <= $point->account) {

                $pre_account = $point->account;
                $profit = ($point->commission/100)*$amount;
                // $point->account = $point->account - $amount;
                $point->takeFromAccount($amount);
                $point->addProfitToAccount($profit);

                $sub->payMonths($month);

                //make a report
                $report = Report::create([
                    'point_id' => $point->id,
                    'report' => "تم شحن تفعيل الباقة $package->name للمشترك رقم $sub->subscriber_number لمدة $month أشهر و تم اقطاع مبلغ $amount من الرصيد وأضافة مبلغ $profit .",
                    'on_him' => $amount,
                    'to_him' => $profit,
                    'pre_account' => $pre_account,
                ]);
                // $report-

                //send a massege to telegram

                session()->flash('success' ,' تم دفع الفاتورة بنجاح');
            } elseif ($point->borrowing_is_allowed) {
                // موضوع الدين
            }
        } else {
            // الغاء التسديد
        }

        return redirect()->back();

    }
}
