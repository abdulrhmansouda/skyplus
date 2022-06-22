<?php

namespace App\Http\Controllers\Accountant;

use App\Enums\BoxTransactionTypeEnum;
use App\Exports\AccountantBoxBankExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Accountant\StoreBoxBankRequest;
use App\Models\BoxBank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BoxBankController extends Controller
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

        $boxBanks = new BoxBank();

        if ($all_date !== "true") {
            preg_match_all("/([^-]*) - (.*)/", $daterange, $date);
            if ($date[1]) {
                $from = new Carbon($date[1][0]);
                $to = new Carbon($date[2][0]);
                $boxBanks = $boxBanks->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to);
            }
        }
        if (!is_null($box_transaction_type)) {
            $boxBanks = $boxBanks->where('box_transaction_type', $box_transaction_type);
        }

        $final_charge_subscriber = (clone $boxBanks)->where('box_transaction_type', BoxTransactionTypeEnum::CHARGE_POINT->value)->pluck('amount')?->sum() ?? 0;
        $final_sell =              (clone $boxBanks)->where('box_transaction_type', BoxTransactionTypeEnum::SELL->value)->pluck('amount')?->sum() ?? 0;
        $final_pay =          -1 * (clone $boxBanks)->where('box_transaction_type', BoxTransactionTypeEnum::PAY->value)->pluck('amount')?->sum() ?? 0;

        return view('accountant.pages.box-bank', [
            'boxBanks' => $boxBanks->get(),

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
        $export = new AccountantBoxBankExport($request);
        $time = now()->format('Y_m_d');
        return Excel::download($export, "AccountantBoxBankExport_{$time}.xlsx");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoxBankRequest $request)
    {
        // dd($request->validated()['account']);
        if ($request->validated()['account'] < 0) {
            session()->flash('error', ' المبلغ الذي في البنك لا يكفي للسحب');
            return redirect()->back();
        }
        BoxBank::create($request->validated());
        session()->flash('success', 'تم اضافة الحركة بنجاح');
        return redirect()->back();
    }
}
