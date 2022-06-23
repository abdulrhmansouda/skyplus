<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BoxTransactionTypeEnum;
use App\Enums\MoneyTransactionTypeEnum;
use App\Enums\PaymentTypeEnum;
use App\Enums\ReportTypeEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\BoxBank;
use App\Models\BoxCash;
use App\Models\Point;
use App\Models\Recharge;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'amount'            => ['required', 'numeric', 'min:0'],
            'payment_type'      => ['required', Rule::in([
                // PaymentTypeEnum::CASH->value,
                PaymentTypeEnum::BANK->value
            ])],
            'note'              => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($request, $id) {

            $amount = $request->amount;

            $point = Point::findOrFail($id);

            $recharge = new Recharge;
            $recharge->point_id = $id;
            $recharge->amount = $amount;
            $recharge->payment_type = $request->payment_type;
            $recharge->note = $request->note;

            $recharge->save();

            //make a reports
            $payment_type_report = ($request->payment_type == PaymentTypeEnum::CASH->value) ? 'نقد' : 'بنك';
            $report_message = "تم شحن الرصيد بقيمة $amount للنقطة $point->name طرقة الدفع : {$payment_type_report}.";

            $report = Report::create([
                'point_id' => $point->id,
                'user_id'  => Auth::user()->id,
                'report' => $report_message,
                // 'on_him' => 0,
                // 'to_him' => $amount,
                'amount'    => $amount,
                'pre_account' => $point->account,
                'account' => $point->account + $amount,
                'type' => ReportTypeEnum::CHARGE_POINT->value,
            ]);
            // dd(1);
            if ($request->payment_type == PaymentTypeEnum::CASH->value) {
                // $last_box_cash = BoxCash::all()->last();
                // $pre_account   = $last_box_cash?->account ?? 0;
                // // $account       = ;
                // BoxCash::create([
                //     'transaction_type'   => MoneyTransactionTypeEnum::PUT_MONEY->value,
                //     'box_transaction_type' => BoxTransactionTypeEnum::CHARGE_POINT->value,
                //     'amount'             => $amount,
                //     'pre_account'        => $pre_account,
                //     'account'            => $pre_account + $amount,
                //     'report'             => $report_message,
                //     'note'               => $request->note,
                //     'user_id'            => Auth::user()->id,
                // ]);
            } elseif ($request->payment_type == PaymentTypeEnum::BANK->value) {
                $last_box_bank = BoxBank::all()->last();
                $pre_account   = $last_box_bank?->account ?? 0;
                // $account       = ;
                BoxBank::create([
                    'transaction_type'   => MoneyTransactionTypeEnum::PUT_MONEY->value,
                    'box_transaction_type' => BoxTransactionTypeEnum::CHARGE_POINT->value,
                    'amount'             => $amount,
                    'pre_account'        => $pre_account,
                    'account'            => $pre_account + $amount,
                    'report'             => $report_message,
                    'note'               => $request->note,
                    'user_id'            => Auth::user()->id,
                ]);
            }

            $point->addToAccount($amount);

            session()->flash('success', "تم شحن المبلغ $amount الى النقطة $point->name بنجاح");
        });
        return redirect()->back();
    }
}
