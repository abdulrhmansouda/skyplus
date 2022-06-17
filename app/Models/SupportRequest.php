<?php

namespace App\Models;

use App\Enums\RequestStatusEnum;
use App\Enums\SupportRequestTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    use HasFactory;

    protected $with = ['point', 'subscriber'];

    protected $guarded = ['id'];
    // helper
    public function request_type_arabic()
    {
        switch ($this->type) {
            case (SupportRequestTypeEnum::MAINTENANCE->value):
                return 'صيانة';

            case (SupportRequestTypeEnum::TRANSFER->value):
                return 'نقل عنوان';

            case (SupportRequestTypeEnum::SWITCH_PACKAGE->value):
                return 'تعديل باقة';
            default:
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

    //Relations
    public function point()
    {
        return $this->belongsTo(Point::class);
    }
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
