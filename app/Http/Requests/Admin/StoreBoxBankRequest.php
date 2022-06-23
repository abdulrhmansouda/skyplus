<?php

namespace App\Http\Requests\Admin;

use App\Enums\BoxTransactionTypeEnum;
use App\Enums\MoneyTransactionTypeEnum;
use App\Models\BoxBank;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class StoreBoxBankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transaction_type'  => ['required', 'numeric', Rule::in([MoneyTransactionTypeEnum::PUT_MONEY->value, MoneyTransactionTypeEnum::TAKE_MONEY->value]),],
            'amount'            => ['required', 'numeric', 'min:0'],
            'report'            => ['required', 'string',],
            'note'              => ['nullable', 'string',],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $last_box_bank = BoxBank::all()->last();
        $pre_account   = $last_box_bank?->account ?? 0;
        // dd($pre_account);
        if ($this->transaction_type == MoneyTransactionTypeEnum::PUT_MONEY->value) {
            $amount        = $this->amount;
            $account       = $pre_account + $amount;
            $box_transaction_type = BoxTransactionTypeEnum::SELL->value;
        }
        if ($this->transaction_type == MoneyTransactionTypeEnum::TAKE_MONEY->value) {
            $amount        = -1 * $this->amount;
            $account       = $pre_account + $amount;
            $box_transaction_type = BoxTransactionTypeEnum::PAY->value;
        }
        return [
            'user_id'   => Auth::user()->id,
            'transaction_type'   => $this->transaction_type,
            'box_transaction_type' => $box_transaction_type,
            'amount'             => $amount,
            'pre_account'        => $pre_account,
            'account'            => $account,
            'report'             => $this->report,
            'note'               => $this->note,
        ];
    }
}
