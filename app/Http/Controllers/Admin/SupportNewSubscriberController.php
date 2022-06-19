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

        $report_message = "تم اضافة المبلغ {$point->new_commission}
         لرصيد النقطة {$point->user->username}
           عمولة على المشترك  الجديد صاحب الرقم{$support_new_subscriber_request->subscriber_phone} .";

        $telegram_message = "
        طلب إضافة مشترك جديد من نقطة البيع  {$point->user->username}

        نوع المهمة : تركيب جديد {$subscription_type}
 
        للمشترك : {$support_new_subscriber_request->subscriber_name}

        رقم التلفون : {$support_new_subscriber_request->subscriber_phone}

        مكان التركيب :  {$support_new_subscriber_request->subscriber_address}

        🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕";

        // important bussnis
        $point->addProfitToAccount($point->new_commission);

        //make a report
        Report::create([
            'point_id' => $point->id,
            'report' => $report_message,
            'on_him' => 0,
            'to_him' => $point->new_commission,
            'pre_account' => $point->account,
            'type' => ReportTypeEnum::COMMISSION->value,
        ]);


        //send a massege to telegram
        TelegramController::newOrSwitchSubscriberMessage($telegram_message);

        $support_new_subscriber_request->status = RequestStatusEnum::ACCEPTED->value;
        $support_new_subscriber_request->update();
    }

    public function acceptSwitchCompany(SupportNewSubscriberRequest $support_new_subscriber_request)
    {
        $point = $support_new_subscriber_request->point;

        $report_message = "تم اضافة المبلغ {$point->switch_commission}
         لرصيد النقطة {$point->user->username}
           عمولة على المشترك  الجديد صاحب الرقم{$support_new_subscriber_request->subscriber_phone} .";

        $telegram_message = "
        طلب إضافة مشترك جديد من نقطة البيع  {$point->user->username}

        نوع المهمة : قلب
 
        للمشترك : {$support_new_subscriber_request->subscriber_name}

        رقم التلفون : {$support_new_subscriber_request->subscriber_phone}

        مكان التركيب :  {$support_new_subscriber_request->subscriber_address}

        🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕🆕";

        // important bussnis
        $point->addProfitToAccount($point->switch_commission);

        //make a report
        Report::create([
            'point_id' => $point->id,
            'report' => $report_message,
            'on_him' => 0,
            'to_him' => $point->switch_commission,
            'pre_account' => $point->account,
            'type' => ReportTypeEnum::COMMISSION->value,
        ]);


        //send a massege to telegram
        TelegramController::newOrSwitchSubscriberMessage($telegram_message);

        $support_new_subscriber_request->status = RequestStatusEnum::ACCEPTED->value;
        $support_new_subscriber_request->update();
    }

    public function rejectNewSubscriber(SupportNewSubscriberRequest $support_new_subscriber_request)
    {
        $support_new_subscriber_request->status = RequestStatusEnum::REJECTED->value;
        $support_new_subscriber_request->update();
    }

    public function rejectSwitchCompany(SupportNewSubscriberRequest $support_new_subscriber_request)
    {
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
