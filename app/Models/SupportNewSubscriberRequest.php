<?php

namespace App\Models;

use App\Enums\RequestStatusEnum;
use App\Enums\SupportRequestTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportNewSubscriberRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

        // helper
        public function request_type_arabic()
        {
            switch ($this->type) {
                case (SupportRequestTypeEnum::NEW_SUBSCRIBER->value):
                    return 'مشترك جديد';
    
                case (SupportRequestTypeEnum::SWITCH_COMPANY->value):
                    return 'قلب اشتراك';
                    return 'SupportRequest Model';
            }
        }
    
        public function request_state_arabic_html()
        {
            switch ($this->status) {
                case (RequestStatusEnum::WAINTING->value):
                    return '<span class="badge badge-sm bg-gradient-warning">انتظار</span>';
                case (RequestStatusEnum::ACCEPTED->value):
                    return '<span class="badge badge-sm bg-gradient-success">مقبول</span>';
                case (RequestStatusEnum::REJECTED->value):
                    return '<span class="badge badge-sm bg-gradient-danger">مرفوض</span>';
                default:
                    return 'SupportRequest Model';
            }
        }

    // Relations
    public function point(){
        return $this->belongsTo(Point::class);
    }

}
