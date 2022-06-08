<?php

namespace App\Models;

use App\Enums\MoneyTransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxCash extends Model
{
    use HasFactory;
    public $guarded = ['id'];
    //methods
    public function transaction_type()
    {
        switch ($this->transaction_type) {
            case (MoneyTransactionTypeEnum::TAKE_MONEY->value):
                return "سحب";
            case (MoneyTransactionTypeEnum::PUT_MONEY->value):
                return "أيداع";
        }
    }
}
