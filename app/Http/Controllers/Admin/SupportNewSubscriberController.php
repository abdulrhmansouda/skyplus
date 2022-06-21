<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReportTypeEnum;
use App\Enums\RequestStatusEnum;
use App\Enums\SupportRequestTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Models\Notification;
use App\Models\Point;
use App\Models\Report;
use App\Models\SupportNewSubscriberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportNewSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $support_notification = Notification::firstOrFail();
        $support_notification->support_new_subscriber_notification = false;
        $support_notification->update();

        $requests = SupportNewSubscriberRequest::latest();
        return view('admin.pages.support-new-subscriber-requests', [
            'requests' => $requests->paginate(10),
        ]);
    }

    public function acceptNewSubscriber(SupportNewSubscriberRequest $support_new_subscriber_request)
    {
        $attributes = json_decode($support_new_subscriber_request->attributes);
        $point = $support_new_subscriber_request->point;
        $subscription_type = $attributes->subscription_type;

        $support_message = "
        تم قبول طلب اشتراك جديد للمشترك صاحب الرقم {$support_new_subscriber_request->subscriber_phone}
          المرسل من النقطة{$point->user->username}.";

        $commission_message = "تم اضافة المبلغ {$point->new_commission}
         لرصيد النقطة {$point->user->username}
           عمولة على المشترك  الجديد صاحب الرقم{$support_new_subscriber_request->subscriber_phone} .";

        $telegram_message = "
        طلب إضافة مشترك جديد من نقطة البيع  {$point->user->username}

        نوع المهمة : تركيب جديد {$subscription_type}
 
        للمشترك : {$support_new_subscriber_request->subscriber_name}

        رقم التلفون : {$support_new_subscriber_request->subscriber_phone}
        
        مكان التركيب :  {$support_new_subscriber_request->subscriber_address}
        
        🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕";

        
        //make a report
        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount'    => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);
        
        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'report' => $commission_message,
            // 'on_him' => 0,
            // 'to_him' => $point->new_commission,
            'amount' => $point->new_commission,
            'pre_account' => $point->account,
            'account' => $point->account + $point->new_commission,
            'type' => ReportTypeEnum::COMMISSION->value,
        ]);
        
        // important business
        $point->addToAccount($point->new_commission);
        
        //send a massege to telegram
        TelegramController::newOrSwitchSubscriberMessage($telegram_message);

        $support_new_subscriber_request->status = RequestStatusEnum::ACCEPTED->value;
        $support_new_subscriber_request->update();
    }

    public function rejectNewSubscriber(SupportNewSubscriberRequest $support_new_subscriber_request)
    {
        $attributes = json_decode($support_new_subscriber_request->attributes);
        $point = $support_new_subscriber_request->point;
        $subscription_type = $attributes->subscription_type;

        $support_message = "
        تم رفض طلب اشتراك جديد للمشترك صاحب الرقم {$support_new_subscriber_request->subscriber_phone}
          المرسل من النقطة{$point->user->username}.";

        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount' => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);

        $support_new_subscriber_request->status = RequestStatusEnum::REJECTED->value;
        $support_new_subscriber_request->update();
    }

    public function acceptSwitchCompany(SupportNewSubscriberRequest $support_new_subscriber_request)
    {
        $point = $support_new_subscriber_request->point;

        $support_message = "
        تم قبول طلب قلب اشتراك للمشترك صاحب الرقم {$support_new_subscriber_request->subscriber_phone}
          المرسل من النقطة{$point->user->username}.";

        $commission_message = "تم اضافة المبلغ {$point->switch_commission}
         لرصيد النقطة {$point->user->username}
           عمولة على المشترك  الجديد صاحب الرقم{$support_new_subscriber_request->subscriber_phone} .";

        $telegram_message = "
        طلب إضافة مشترك جديد من نقطة البيع  {$point->user->username}

        نوع المهمة : قلب
 
        للمشترك : {$support_new_subscriber_request->subscriber_name}

        رقم التلفون : {$support_new_subscriber_request->subscriber_phone}

        مكان التركيب :  {$support_new_subscriber_request->subscriber_address}

        🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕";

        
        //make a report
        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount' => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);
        
        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'report' => $commission_message,
            // 'on_him' => 0,
            // 'to_him' => $point->switch_commission,
            'amount' => $point->switch_commission,
            'pre_account' => $point->account,
            'account' => $point->account + $point->switch_commission,
            'type' => ReportTypeEnum::COMMISSION->value,
        ]);
        
        // important business
        $point->addToAccount($point->switch_commission);
        
        //send a massege to telegram
        TelegramController::newOrSwitchSubscriberMessage($telegram_message);
        
        $support_new_subscriber_request->status = RequestStatusEnum::ACCEPTED->value;
        $support_new_subscriber_request->update();
    }

    public function rejectSwitchCompany(SupportNewSubscriberRequest $support_new_subscriber_request)
    {
        $point = $support_new_subscriber_request->point;

        $support_message = "
        تم رفض طلب قلب اشتراك للمشترك صاحب الرقم {$support_new_subscriber_request->subscriber_phone}
          المرسل من النقطة{$point->user->username}.";

        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount' => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);

        $support_new_subscriber_request->status = RequestStatusEnum::REJECTED->value;
        $support_new_subscriber_request->update();
    }

    public function acceptRequest($support_new_subscriber_request_id)
    {
        DB::beginTransaction();
        try {
            $support_request = SupportNewSubscriberRequest::findOrFail($support_new_subscriber_request_id);
            switch ($support_request->type) {
                case (SupportRequestTypeEnum::NEW_SUBSCRIBER->value):
                    $this->acceptNewSubscriber($support_request);
                    break;
                case (SupportRequestTypeEnum::SWITCH_COMPANY->value):
                    $this->acceptSwitchCompany($support_request);
                    break;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        session()->flash('success', 'تم قبول طلب الدعم بنجاح');
        return redirect()->back();
    }

    public function rejectRequest($support_new_subscriber_request_id)
    {
        DB::beginTransaction();
        try {
            $support_request = SupportNewSubscriberRequest::findOrFail($support_new_subscriber_request_id);
            switch ($support_request->type) {
                case (SupportRequestTypeEnum::NEW_SUBSCRIBER->value):
                    $this->rejectNewSubscriber($support_request);
                    break;
                case (SupportRequestTypeEnum::SWITCH_COMPANY->value):
                    $this->rejectSwitchCompany($support_request);
                    break;
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        session()->flash('success', 'تم رفض الطلب بنجاح');

        return redirect()->back();
    }
}
