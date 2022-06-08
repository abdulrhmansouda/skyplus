<?php

namespace App\Http\Requests\Accountant;

use App\Enums\MoneyTransactionTypeEnum;
use App\Models\BoxCash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreBoxCashRequest extends FormRequest
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
            'amount'            => ['required', 'numeric',],
            'report'            => ['required', 'string',],
            'note'              => ['nullable', 'string',],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $last_box_cash = BoxCash::orderBy('created_at', 'DESC')->get()->last();
        $pre_account   = $last_box_cash?->account ?? 0;
        if ($this->transaction_type == MoneyTransactionTypeEnum::PUT_MONEY->value) {
            $account       = $pre_account + $this->amount;
        } elseif ($this->transaction_type == MoneyTransactionTypeEnum::TAKE_MONEY->value) {
            $account       = $pre_account - $this->amount;
        }
        return [
            'transaction_type'   => $this->transaction_type,
            'account'            => $account,
            'pre_account'        => $pre_account,
            'report'             => $this->report,
            'note'               => $this->note,
        ];
    }
}
