<?php

namespace App\Models;

use App\Enums\ReportTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $with = ['point'];

    protected $guarded = ['id'];

    //helpers
    public function operationSupervisor()
    {
        if(isset($this->user))
        return $this->user->roleText() . "\\" . $this->user->username;
        return '_';
    }

    public function reportType()
    {
        switch($this->type){
            case (ReportTypeEnum::CHARGE_POINT->value):return 'شحن لنقطة';
            case (ReportTypeEnum::CHARGE_SUBSCRIBER->value):return 'تسديد لمشترك';
            case (ReportTypeEnum::COMMISSION->value):return 'عمولات';
            case (ReportTypeEnum::SUPPORT->value):return 'دعم';
        }
    }

    // public function operationSupervisor()
    // {
    //     return $this->user->roleText() . "\\" . $this->user->username;
    // }

    public function getTypeReportAttribute()
    {
        switch ($this->type) {
            case "charge_point":
                return 'شحن رصيد لنقطة';
            case "charge_subscriber":
                return 'تفعيل باقة لمشترك';
        }
    }

    // Relations
    public function point()
    {
        return $this->belongsTo(Point::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
