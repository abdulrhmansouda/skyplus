<?php

namespace App\Http\Controllers\Point;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Http\Requests\Point\ChargeSubscriberRequest;
use App\Models\Invoice;
use App\Models\ProjectSetting;
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

        $reports = Report::where('type', 'charge_subscriber')
            ->where('point_id', Auth::user()->point->id)
            ->whereDate('created_at', now()->format('Y-m-d'))->get();

        return view('point.pages.subscribers', [
            'subs' => $subs->get(),
            'reports' => $reports,
            'search' => $s,
        ]);
    }


    public function charge(ChargeSubscriberRequest $request, $id)
    {
        $month = $request->month;
        $pay = $request->pay;


        $sub = Subscriber::findOrFail($id);
        $package = $sub->package;
        $point = Auth::user()->point;

        if ($pay === 'true') {
            $amount = $month * $package->price;
            // موضوع الدين
            $maximum_amount_of_borrowing = ProjectSetting::firstOrFail()->maximum_amount_of_borrowing;
            if (($amount > $point->account) && ($amount > $point->account + $maximum_amount_of_borrowing || !$point->borrowing_is_allowed)) {
                session()->flash('error', 'لا يوجد رصيد كافي لتنفيذ عملية الشحن هذه');
                return redirect()->back();
            }
            // انتهاء موضوع الدين

            $pre_account = $point->account;
            $profit = ($point->commission / 100) * $amount;
            $point->takeFromAccount($amount);
            $point->addProfitToAccount($profit);

            $sub->payMonths($month);

            $message = "تم شحن/تفعيل الباقة $package->name للمشترك رقم $sub->subscriber_number لمدة $month أشهر و تم اقطاع مبلغ $amount من الرصيد وأضافة مبلغ $profit .";

            //make a report
            Report::create([
                'point_id' => $point->id,
                'report' => $message,
                'on_him' => $amount,
                'to_him' => $profit,
                'pre_account' => $pre_account,
                'type' => 'charge_subscriber',
            ]);

            //send a massege to telegram
            TelegramController::chargeMessage($message);

            // make a invoice

            Invoice::create([
                'point_id' => $point->id,
                'subscriber_id' => $sub->id,
                'amount' => $amount,

                'month' => $month,
            ]);


            session()->flash('success', ' تم دفع الفاتورة بنجاح');
        } else {
            // الغاء التسديد
            $invoice_month = Invoice::where('subscriber_id', $sub->id)
                ->where('point_id', $point->id)
                ->whereDate('created_at', now()->format('Y-m-d'))
                ->sum('month') ?? 0;

            if ($month > $invoice_month) {
                session()->flash('error', 'انت لم تقم بدفع هذه الفاتور تأكد من المعلومات');
                return redirect()->back();
            }

            $amount = $month * $package->price;
            $pre_account = $point->account;
            $profit = ($point->commission / 100) * $amount;

            $point->addToAccount($amount);
            $point->takeProfitFromAccount($profit);

            $sub->cancelPayMonths($month);

            $message = "تم ألغاء شحن/تفعيل الباقة $package->name للمشترك رقم $sub->subscriber_number لمدة $month أشهر و تم الغاء اقطاع مبلغ $amount من الرصيد و الغاء أضافة مبلغ $profit .";

            //make a report
            Report::create([
                'point_id' => $point->id,
                'report' =>  $message,
                'on_him' => -1 * $amount,
                'to_him' => -1 * $profit,
                'pre_account' => $pre_account,
                'type' => 'charge_subscriber',
            ]);

            //send a massege to telegram
            TelegramController::chargeMessage($message);

            // make a invoice

            Invoice::create([
                'point_id' => $point->id,
                'subscriber_id' => $sub->id,
                'amount' => -1 * $amount,
                'month' => -1 * $month,
            ]);


            session()->flash('success', ' تم الغاء دفع الفاتورة بنجاح');
        }

        return redirect()->back();
    }
}
