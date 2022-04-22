<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'image',
        'account',
        'tc',
        'note',
        'borrowingIsAllowed',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
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

    public function takeFromAccount($amount)
    {
        if ($amount > 0) {
            $this->account = $this->account - $amount;
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
}
