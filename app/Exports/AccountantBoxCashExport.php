<?php

namespace App\Exports;

use App\Enums\BoxTransactionTypeEnum;
use App\Models\BoxCash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToArray;

class AccountantBoxCashExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // private $reports,
    // $name_points,
    // $pre,$from,$to,
    // $pre_account;
    private $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $daterange = $this->request->daterange;
        $all_date = $this->request->all_date;
        $box_transaction_type = $this->request->box_transaction_type;

        $boxCashs = new BoxCash;

        if ($all_date !== "true") {
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

        $boxCashs = $boxCashs->get();

        $from = isset($from) ? $from->format('d/m/Y') : 'all';
        $to = isset($to) ? $to->format('d/m/Y') : 'all';

        /////////////////////

        $col = new Collection([['الصندوق النقدي',]]);
        $col = $col->add(['اعتبار من', $from, 'الى', $to,]);
        $col = $col->add(['التاريخ', 'مشرف العملية', 'البيان', 'ملاحظات', 'نوع الفاتورة', 'قيمة الفاتورة', 'الرصيد']);
        $col = $col->add(['', '', '', '', '', '', "{$boxCashs?->first()->pre_acount}" ?? 0]);
        foreach ($boxCashs as $boxCash) {
            $col = $col->add([
                $boxCash->created_at,
                $boxCash->operationSupervisor(),
                $boxCash->report,
                $boxCash->note,
                $boxCash->boxTransactionType(),
                "{$boxCash->amount}",
                "{$boxCash->account}",
            ]);
        }
        $col = $col->add(['']);
        $col = $col->add([
            'مجموع شحن الارصدة', "{$final_charge_subscriber}",
            'الوارد', "{$final_sell}",
            'الصادر', "{$final_pay}"
        ]);

        // $col = $col->merge($this->subs->get()->toArray());

        return $col;
    }
}
