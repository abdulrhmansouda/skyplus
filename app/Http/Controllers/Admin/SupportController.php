<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReportTypeEnum;
use App\Enums\RequestStatusEnum;
use App\Enums\SupportRequestTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Point;
use App\Models\Report;
use App\Models\Subscriber;
use App\Models\SupportRequest;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{


    public function index()
    {
        $support_notification = Notification::firstOrFail();
        $support_notification->support_notification = false;
        $support_notification->update();

        $requests = SupportRequest::latest();
        return view('admin.pages.support-requests', [
            'requests' => $requests->paginate(10),
        ]);
    }

    public function acceptSwitchPackgeAndCharge(SupportRequest $support_request)
    {
        $attributes = json_decode($support_request->attributes);
        $sub = Subscriber::findOrFail($attributes->subscriber_id);
        $pre_package = Package::findOrFail($attributes->pre_package_id);
        $new_package = Package::findOrFail($attributes->new_package_id);
        $sub->package_id = $new_package->id;
        $sub->update();

        $point = Point::findOrFail($attributes->point_id);

        $months = $attributes->months;
        $amount = $attributes->amount;
        $profit = $attributes->profit;

        $message = "
        تم قبول طلب تغير الباقة للمشترك رقم {$sub->subscriber_number}
         من الباقة {$pre_package->name}
          ال الباقة {$new_package->name}
           وشحن فواتير عدد $months
            أشهر و تم اقطاع مبلغ $amount
             من الرصيد.";
        $message_profit = "تم اضافة المبلغ $profit لرصيد النقطة {$point->user->username} عمولة شحن رصيد للمشترك {$sub->subscriber_number} .";
        $telegram_message = "
        تم ترقية فاتورة من نقطة البيع  {$point->user->username}
        للمشترك {$sub->sub_username}
        Eski Tarife: ({$pre_package->name}) + ({$pre_package->price})
        
      عدد الفواتير : {$months}
        المبلغ المدفوع : {$amount}
      Yeni Tarife: ({$new_package->name}) + ({$new_package->price})
      
      http://192.168.106.24/issmanager/tarife_degistir&{$sub->sub_id}
      
      ♻️♻️♻️♻️♻️♻️♻️♻️♻️♻️♻️♻️";

        // العمليات المهمة جداً
        $point->takeFromAccount($amount);
        $point->addProfitToAccount($profit);

        $sub->payMonths($months);

        //make a report
        Report::create([
            'point_id' => $point->id,
            'report' => $message,
            'on_him' => $amount,
            'to_him' => 0,
            'pre_account' => $point->account,
            'type' => ReportTypeEnum::SWITCH_PACKAGE->value,
        ]);

        Report::create([
            'point_id' => $point->id,
            'report' => $message_profit,
            'on_him' => 0,
            'to_him' => $profit,
            'pre_account' => $point->account - $amount,
            'type' => ReportTypeEnum::COMMISSION->value,
        ]);

        // make a invoice
        Invoice::create([
            'point_id' => $point->id,
            'subscriber_id' => $sub->id,
            'amount' => $amount,
            'months' => $months,
        ]);

        //send a massege to telegram
        TelegramController::chargeMessage($telegram_message);

        $support_request->status = RequestStatusEnum::ACCEPTED->value;
        $support_request->update();
    }

    public function rejectSwitchPackgeAndCharge(SupportRequest $support_request)
    {
        $attributes = json_decode($support_request->attributes);
        $sub = Subscriber::findOrFail($attributes->subscriber_id);
        $pre_package = Package::findOrFail($attributes->pre_package_id);
        $new_package = Package::findOrFail($attributes->new_package_id);

        $point = Point::findOrFail($attributes->point_id);

        $months = $attributes->months;
        $amount = $attributes->amount;
        $profit = $attributes->profit;

        $message = "
        تم رفض طلب تغير الباقة للمشترك رقم {$sub->subscriber_number}
         من الباقة {$pre_package->name}
          ال الباقة {$new_package->name}.";

        // العمليات المهمة جداً
        $point->takeFromAccount($profit);
        $point->addProfitToAccount($amount);

        //make a report
        Report::create([
            'point_id' => $point->id,
            'report' => $message,
            'on_him' => 0,
            'to_him' => 0,
            'pre_account' => $point->account,
            'type' => ReportTypeEnum::SWITCH_PACKAGE->value,
        ]);

        $support_request->status = RequestStatusEnum::REJECTED->value;
        $support_request->update();
    }


    public function acceptMaintenance(SupportRequest $support_request)
    {
        $attributes = json_decode($support_request->attributes);
        $subscriber = Subscriber::findOrFail($attributes->subscriber_id);
        $point = Point::findOrFail($attributes->point_id);

        $telegram_message = "
        طلب صيانة من نقطة البيع  {$point->user->username}

        للمشترك {$subscriber->sub_username}

        نوع الصيانة :  {$attributes->maintenance_request_type}

        http://192.168.106.24/issmanager/kullanici_detay&{$subscriber->sub_id}

        🛠️⚙️🛠️⚙️🛠️🛠️⚙️🛠️⚙️🛠️🛠️⚙️🛠️⚙️🛠️";

        //send a massege to telegram
        TelegramController::maintenanceMessage($telegram_message);

        $support_request->status = RequestStatusEnum::ACCEPTED->value;
        $support_request->update();
    }

    public function rejectMaintenance(SupportRequest $support_request)
    {
        $support_request->status = RequestStatusEnum::REJECTED->value;
        $support_request->update();
    }

    public function acceptTransfer(SupportRequest $support_request)
    {
        $attributes = json_decode($support_request->attributes);
        $subscriber = Subscriber::findOrFail($attributes->subscriber_id);
        $point = Point::findOrFail($attributes->point_id);

        $telegram_message = "
        طلب صيانة من نقطة البيع  {$point->user->username}

        للمشترك {$subscriber->sub_username}

        نوع الصيانة :  {$attributes->maintenance_request_type}

        http://192.168.106.24/issmanager/kullanici_detay&{$subscriber->sub_id}

        🛠️⚙️🛠️⚙️🛠️🛠️⚙️🛠️⚙️🛠️🛠️⚙️🛠️⚙️🛠️";

        //send a massege to telegram
        TelegramController::transferMessage($telegram_message);

        $support_request->status = RequestStatusEnum::ACCEPTED->value;
        $support_request->update();
    }

    public function rejectTransfer(SupportRequest $support_request)
    {
        $support_request->status = RequestStatusEnum::REJECTED->value;
        $support_request->update();
    }

    public function acceptRequest($support_request_id)
    {
        DB::beginTransaction();
        try {
            $support_request = SupportRequest::findOrFail($support_request_id);
            switch ($support_request->type) {
                case (SupportRequestTypeEnum::SWITCH_PACKAGE->value):
                    $this->acceptSwitchPackgeAndCharge($support_request);
                    break;
                case (SupportRequestTypeEnum::MAINTENANCE->value):
                    $this->acceptMaintenance($support_request);
                    break;
                case (SupportRequestTypeEnum::TRANSFER->value):
                    $this->acceptTransfer($support_request);
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

    public function rejectRequest($support_request_id)
    {
        DB::beginTransaction();
        try {
            $support_request = SupportRequest::findOrFail($support_request_id);
            switch ($support_request->type) {
                case (SupportRequestTypeEnum::SWITCH_PACKAGE->value):
                    $this->rejectSwitchPackgeAndCharge($support_request);
                    break;
                case (SupportRequestTypeEnum::MAINTENANCE->value):
                    $this->rejectMaintenance($support_request);
                    break;
                case (SupportRequestTypeEnum::TRANSFER->value):
                    $this->rejectTransfer($support_request);
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
