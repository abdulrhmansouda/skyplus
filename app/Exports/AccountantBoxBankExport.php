<?php

namespace App\Exports;

use App\Enums\BoxTransactionTypeEnum;
use App\Models\BoxBank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToArray;

class AccountantBoxBankExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
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

        $boxBanks = new BoxBank;

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

        $boxBanks = $boxBanks->get();

        $from = isset($from) ? $from->format('d/m/Y') : 'all';
        $to = isset($to) ? $to->format('d/m/Y') : 'all';

        /////////////////////

        $col = new Collection([['البنك',]]);
        $col = $col->add(['اعتبار من', $from, 'الى', $to,]);
        $col = $col->add(['التاريخ', 'مشرف العملية', 'البيان', 'ملاحظات', 'نوع الفاتورة', 'قيمة الفاتورة', 'الرصيد']);
        $col = $col->add(['', '', '', '', '', '', "{$boxBanks?->first()->pre_acount}" ?? 0]);
        foreach ($boxBanks as $boxBank) {
            $col = $col->add([
                $boxBank->created_at,
                $boxBank->operationSupervisor(),
                $boxBank->report,
                $boxBank->note,
                $boxBank->boxTransactionType(),
                "{$boxBank->amount}",
                "{$boxBank->account}",
            ]);
        }
        $col = $col->add(['']);
        $col = $col->add(['مجموع شحن الارصدة', "{$final_charge_subscriber}",
         'الوارد', "{$final_sell}",
          'الصادر', "{$final_pay}"]);

        // $col = $col->merge($this->subs->get()->toArray());

        return $col;
    }
}
