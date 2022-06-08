<?php

namespace App\Models;

use App\Enums\UserStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $guarded = [
        'id',
    ];
    //Methods

    public function status(){
        switch($this->status){
            case(UserStatusEnum::ACTIVE->value):    return '<span class="badge badge-sm bg-gradient-success">مفعل</span>';
            case(UserStatusEnum::INACTIVE->value):  return '<span class="badge badge-sm bg-gradient-warning">غير مفعل</span>';
            case(UserStatusEnum::CLOSED->value):    return '<span class="badge badge-sm bg-gradient-danger">مغلق</span>';
        }
        //        <span class="badge badge-sm bg-gradient-secondary text-white">مغلق</span>
    }

    public function getImageUrlAttribute()
    {

        $image = $this->image;

        if ($image) {
            return asset("images/$image");
        }

        return asset('images/default_user.png');
    }

    public function addToAccount($amount)
    {
        if ($amount > 0) {
            $this->account = $this->account + $amount;
            $this->update();
            return true;
        }
        return false;
    }

    public function takeFromAccount($amount)
    {
        if ($amount > 0) {
            $this->account = $this->account - $amount;
            $this->update();
            return true;
        }
        return false;
    }

    public function addProfitToAccount($amount)
    {
        if ($amount > 0) {
            $this->account = $this->account + $amount;
            $this->daily_profit = $this->daily_profit + $amount;
            $this->update();
            return true;
        }
        return false;
    }

    public function takeProfitFromAccount($amount)
    {
        if ($amount > 0) {
            $this->account = $this->account - $amount;
            $this->daily_profit = $this->daily_profit - $amount;
            $this->update();
            return true;
        }
        return false;
    }

    public static function resetDailyProfit(){
        foreach(static::all() as $point){
            $point->daily_profit = 0;
            $point->update();
        }
    }

    //Relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }


}
