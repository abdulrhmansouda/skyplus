<?php

namespace App\Models;

use App\Enums\BoxTransactionTypeEnum;
use App\Enums\MoneyTransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxCash extends Model
{
    use HasFactory;
    public $guarded = ['id'];
    // public function transaction_type()
    // {
    //     switch ($this->transaction_type) {
    //         case (MoneyTransactionTypeEnum::TAKE_MONEY->value):
    //             return "سحب";
    //         case (MoneyTransactionTypeEnum::PUT_MONEY->value):
    //             return "أيداع";
    //     }
    // }

        //helpers
        public function operationSupervisor()
        {
            if(isset($this->user))
            return $this->user->roleText() . "\\" . $this->user->username;
            return '_';
        }

    public function boxTransactionType()
    {
        switch ($this->box_transaction_type) {
            case (BoxTransactionTypeEnum::CHARGE_POINT->value):
                return "شحن رصيد";
            case (BoxTransactionTypeEnum::SELL->value):
                return "بيع";
            case (BoxTransactionTypeEnum::PAY->value):
                return "دفع";
        }
    }

    // Relations
    public function user(){
        return $this->belongsTo(User::class);
    }
}
