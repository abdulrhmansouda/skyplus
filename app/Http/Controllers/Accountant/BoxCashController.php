<?php

namespace App\Http\Controllers\Accountant;

use App\Enums\BoxTransactionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Accountant\StoreBoxCashRequest;
use App\Models\BoxCash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoxCashController extends Controller
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
        $box_transaction_type = $request->box_transaction_type ?? null;

        $boxCashs = new BoxCash;

        if ($all_date !== "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $pre = $from->addDays(-1);
                $to = new Carbon($date[2][0]);
                $boxCashs = $boxCashs->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }
        if (!is_null($box_transaction_type)) {
            $boxCashs = $boxCashs->where('box_transaction_type', $box_transaction_type);
        }

        // $boxCashs = $boxCashs
        //     ->orderBy('created_at');

        $final_charge_subscriber = (clone $boxCashs)->where('box_transaction_type', BoxTransactionTypeEnum::CHARGE_POINT->value)->pluck('amount')?->sum() ?? 0;
        $final_sell =              (clone $boxCashs)->where('box_transaction_type', BoxTransactionTypeEnum::SELL->value)->pluck('amount')?->sum() ?? 0;
        $final_pay =               (clone $boxCashs)->where('box_transaction_type', BoxTransactionTypeEnum::PAY->value)->pluck('amount')?->sum() ?? 0;

        $pre_account = (clone $boxCashs)?->first()?->pre_account ?? 0;
        return view('accountant.pages.box-cash', [
            // 'pre_account' => $pre_account,
            'boxCashs' => $boxCashs->get(),
            'daterange' => $daterange,
            'all_date' => $all_date,
            'box_transaction_type' => $box_transaction_type,
            'pre' => isset($pre) ? $pre->format('d/m/Y') : 'all',
            'from' => isset($from) ? $from->format('d/m/Y') : 'all',
            'to' => isset($to) ? $to->format('d/m/Y') : 'all',
            'final_charge_subscriber'   =>  $final_charge_subscriber,
            'final_sell'    =>  $final_sell,
            'final_pay'     =>  $final_pay,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoxCashRequest $request)
    {
        // dd($request->validated()['account']);
        if ($request->validated()['account'] < 0) {
            session()->flash('error', ' المبلغ الذي في الصندوق لا يكفي للسحب');
            return redirect()->back();
        }
        BoxCash::create($request->validated());
        session()->flash('success', 'تم اضافة الحركة بنجاح');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoxCash  $boxCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoxCash $boxCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoxCash  $boxCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoxCash $boxCash)
    {
        //
    }
}
