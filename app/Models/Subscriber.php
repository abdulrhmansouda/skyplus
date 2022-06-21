<?php

namespace App\Models;

use App\Enums\UserStatusEnum;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    protected $with = [
        'package',
    ];

    // helpers
    public function status(){
        switch($this->status){
            case(UserStatusEnum::ACTIVE->value):    return '<span class="badge badge-sm bg-gradient-success">مفعل</span>';
            case(UserStatusEnum::INACTIVE->value):  return '<span class="badge badge-sm bg-gradient-warning">غير مفعل</span>';
            case(UserStatusEnum::CLOSED->value):    return '<span class="badge badge-sm bg-gradient-danger">مغلق</span>';
        }
        //        <span class="badge badge-sm bg-gradient-secondary text-white">مغلق</span>
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getPackageNameAttribute()
    {
        return $this->package->name;
    }

    // public function getStateAttribute()
    // {
    //     switch ($this->status) {
    //         case 'active':
    //             return 'مفعل';
    //         case 'deactive':
    //             return 'غير مفعل';
    //         case 'closed':
    //             return 'مغلق';
    //     }
    // }

    public function getStartPackageAttribute()
    {
        return date_format(date_create($this->package_start), 'Y-m-d');
    }

    public function getEndPackageAttribute()
    {
        return date_format(date_create($this->package_end), 'Y-m-d');
    }

    public function getDaysToEndAttribute()
    {
        $d1 = new Carbon(now());
        $d2 = new Carbon($this->package_end);
        return $d1->diffInDays($d2, false) > 0 ? $d1->diffInDays($d2, false) : 0;
    }

    public static function convertToDeactive()
    {
        $subs = static::where('status', UserStatusEnum::ACTIVE->value)->get();
        foreach ($subs as $sub) {
            if ($sub->days_to_end == 0) {
                $sub->status = UserStatusEnum::INACTIVE->value;
                $sub->update();
            }
        }
    }

    public function payMonths($month)
    {
        if ($this->days_to_end) {
            $start = new Carbon($this->package_start);
            $end = new Carbon($this->package_end);
            $start = $start->addDays(30 * $month);
            $end = $end->addDays(30 * $month);
            $this->package_start = $start;
            $this->package_end = $end;
            $this->update();
        } else {
            $now = new Carbon(now());
            $this->package_start = $now;
            $end = clone ($now);
            $end = $end->addDays(30 * $month);
            $this->package_end = $end;

            $this->status = UserStatusEnum::ACTIVE->value;
            $this->update();
        }
    }

    public function payDays($days)
    {
        if ($this->days_to_end) {
            $start = new Carbon($this->package_start);
            $end = new Carbon($this->package_end);
            $start = $start->addDays($days);
            $end = $end->addDays($days);
            $this->package_start = $start;
            $this->package_end = $end;
            $this->update();
        } else {
            $now = new Carbon(now());
            $this->package_start = $now;
            $end = clone ($now);
            $end = $end->addDays($days);
            $this->package_end = $end;

            $this->status = UserStatusEnum::ACTIVE->value;
            $this->update();
        }
    }

    public function cancelPayMonths($month)
    {

            $start = new Carbon($this->package_start);
            $end = new Carbon($this->package_end);
            $start = $start->addDays(-30 * $month);
            $end = $end->addDays(-30 * $month);
            $this->package_start = $start;
            $this->package_end = $end;
            $this->update();
            // dd($this->days_to_end);
            if(!$this->days_to_end){
            $this->status = UserStatusEnum::INACTIVE->value;
            $this->update();
        }

        
    }

    
}
