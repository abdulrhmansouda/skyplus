<?php

namespace App\Http\Controllers\Accountant;

use App\Enums\BoxTransactionTypeEnum;
use App\Exports\AccountantBoxCashExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Accountant\StoreBoxCashRequest;
use App\Models\BoxCash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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

        if ($all_date != "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $to = new Carbon($date[2][0]);
                $boxCashs = $boxCashs->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }
        if (!is_null($box_transaction_type)) {
            $boxCashs = $boxCashs->where('box_transaction_type', $box_transaction_type);
        }

        $final_charge_subscriber = (clone $boxCashs)->where('box_transaction_type', BoxTransactionTypeEnum::CHARGE_POINT->value)->pluck('amount')?->sum() ?? 0;
        $final_sell =              (clone $boxCashs)->where('box_transaction_type', BoxTransactionTypeEnum::SELL->value)->pluck('amount')?->sum() ?? 0;
        $final_pay =          -1 * (clone $boxCashs)->where('box_transaction_type', BoxTransactionTypeEnum::PAY->value)->pluck('amount')?->sum() ?? 0;

        return view('accountant.pages.box-cash', [
            'boxCashs' => $boxCashs->get(),

            'daterange' => $daterange,
            'all_date' => $all_date,
            'box_transaction_type' => $box_transaction_type,

            'from' => isset($from) ? $from->format('d/m/Y') : 'all',
            'to' => isset($to) ? $to->format('d/m/Y') : 'all',
            'final_charge_subscriber'   =>  $final_charge_subscriber,
            'final_sell'    =>  $final_sell,
            'final_pay'     =>  $final_pay,
        ]);
    }

    public function export(Request $request)
    {
        $export = new AccountantBoxCashExport($request);
        $time = now()->format('Y_m_d');
        return Excel::download($export, "AccountantBoxCashExport_{$time}.xlsx");
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
}
