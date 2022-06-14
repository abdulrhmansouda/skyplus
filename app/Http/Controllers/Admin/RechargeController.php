<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MoneyTransactionTypeEnum;
use App\Enums\PaymentTypeEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\BoxCash;
use App\Models\Point;
use App\Models\Recharge;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RechargeController extends Controller
{
    public function index(Request $request)
    {

        $s = $request->s ?? '';

        $points = Point::where('status', UserStatusEnum::ACTIVE->value)->where('name', 'LIKE', "%$s%");

        return view('admin.pages.recharge', [
            'points' => $points->paginate(10),
            'search' => $s,
        ]);
    }

    public function charge(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
            'payment_type' => ['required', Rule::in([PaymentTypeEnum::CASH->value, PaymentTypeEnum::BANK->value])],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);


        $amount = $request->amount;

        $point = Point::findOrFail($id);

        $recharge = new Recharge;
        $recharge->point_id = $id;
        $recharge->amount = $amount;
        $recharge->payment_type = $request->payment_type;
        $recharge->note = $request->note;

        $recharge->save();
        $pre_account = $point->account;
        $point->account = $point->account + $amount;
        $point->update();

        //make a reports
        $report_message = "تم شحن الرصيد بقيمة $amount للنقطة $point->name طرقة الدفع : $request->payment_type.";
        $report = Report::create([
            'point_id' => $point->id,
            'report' => $report_message,
            'on_him' => 0,
            'to_him' => $amount,
            'pre_account' => $pre_account,
            'type' => 'charge_point',
        ]);
        // dd(1);
        if ($request->payment_type == PaymentTypeEnum::CASH->value) {
            $last_box_cash = BoxCash::orderBy('created_at')->get()->last();
            $pre_account   = $last_box_cash?->account ?? 0;
            $account       = $pre_account + $amount;
            BoxCash::create([
                'transaction_type'   => MoneyTransactionTypeEnum::PUT_MONEY->value,
                'account'            => $account,
                'pre_account'        => $pre_account,
                'report'             => $report_message,
                'note'               => $request->note,
            ]);
        } elseif ($request->payment_type == PaymentTypeEnum::BANK->value) {
            dd('rechargecontroller_bank');
        }

        session()->flash('success', "تم شحن المبلغ $amount الى النقطة $point->name بنجاح");
        return redirect()->back();
    }
}
