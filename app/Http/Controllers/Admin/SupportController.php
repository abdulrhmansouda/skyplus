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
use Illuminate\Support\Facades\Auth;
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
        // $profit = $attributes->profit;

        $support_message = "
        تم قبول طلب تغير الباقة للمشترك رقم {$sub->subscriber_number}
         من الباقة {$pre_package->name}
          ال الباقة {$new_package->name}
          المرسل من النقطة{$point->user->username}.";

        // $charge_message = "تم شحن/تفعيل الباقة {$new_package->name}
        //  للمشترك رقم {$sub->subscriber_number}
        //   لمدة {$months}
        //    أشهر و تم اقطاع مبلغ {$amount}
        //     من الرصيد.";

        // $commission_message = "تم اضافة المبلغ {$profit}
        //  لرصيد النقطة {$point->user->username}
        //   عمولة شحن رصيد للمشترك {$sub->subscriber_number} .";

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

        //make a report
        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'subscriber_id' => $sub->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount'    => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);

        // Report::create([
        //     'point_id' => $point->id,
        //     'user_id'  => Auth::user()->id,
        //     'subscriber_id' => $sub->id,
        //     'report' => $charge_message,
        //     'on_him' => $amount,
        //     'to_him' => 0,
        //     'pre_account' => $point->account,
        //     'account' => $point->account - $amount,
        //     'type' => ReportTypeEnum::CHARGE_SUBSCRIBER->value,
        // ]);

        // Report::create([
        //     'point_id' => $point->id,
        //     'user_id'  => Auth::user()->id,
        //     'subscriber_id' => $sub->id,
        //     'report' => $commission_message,
        //     'on_him' => 0,
        //     'to_him' => $profit,
        //     'pre_account' => $point->account,
        //     'account' => $point->account + $profit,
        //     'type' => ReportTypeEnum::COMMISSION->value,
        // ]);

        // make a invoice
        Invoice::create([
            'point_id' => $point->id,
            'subscriber_id' => $sub->id,
            'amount' => $amount,
            'months' => $months,
        ]);

        // $point->takeFromAccount($amount);
        // $point->addToAccount($profit);

        $sub->payMonths($months);

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

        $support_message = "
          تم رفض طلب تغير الباقة للمشترك رقم {$sub->subscriber_number}
           من الباقة {$pre_package->name}
            ال الباقة {$new_package->name}
            المرسل من النقطة{$point->user->username}.";


        $charge_message = "
        تم اعادة مبلغ:{$amount}
        لرصيد النقطة {$point->user->username}
        بسبب رفض طلب ترقية الباقة {$new_package->name}
         للمشترك رقم {$sub->subscriber_number}.";

        $commission_message = "تم سحب المنحة {$profit}
         من رصيد النقطة {$point->user->username}
         بسبب رفض طلب ترقية الباقة {$new_package->name}
         للمشترك رقم {$sub->subscriber_number}.";

        // العمليات المهمة جداً

        //make a report
        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'subscriber_id' => $sub->id,
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
            'subscriber_id' => $sub->id,
            'report' => $commission_message,
            // 'on_him' => $profit,
            // 'to_him' => 0,
            'amount'    => -1 * $profit,
            'pre_account' => $point->account,
            'account' => $point->account - $profit,
            'type' => ReportTypeEnum::COMMISSION->value,
        ]);
        $point->takeFromAccount($profit);

        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'subscriber_id' => $sub->id,
            'report' => $charge_message,
            // 'on_him' => 0,
            // 'to_him' => $amount,
            'amount'    => $amount,
            'pre_account' => $point->account,
            'account' => $point->account + $amount,
            'type' => ReportTypeEnum::CHARGE_SUBSCRIBER->value,
        ]);
        $point->addToAccount($amount);


        $support_request->status = RequestStatusEnum::REJECTED->value;
        $support_request->update();
    }

    public function acceptMaintenance(SupportRequest $support_request)
    {
        $attributes = json_decode($support_request->attributes);
        $subscriber = Subscriber::findOrFail($attributes->subscriber_id);
        $point = Point::findOrFail($attributes->point_id);

        // create report
        $support_message = "
        تم قبول طلب الصيانة من النوع: {$attributes->maintenance_request_type}
         للمشترك رقم {$subscriber->subscriber_number}
         المرسل من النقطة{$point->user->username}.";

        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'subscriber_id' => $subscriber->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount'    => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);


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
        $attributes = json_decode($support_request->attributes);
        $subscriber = Subscriber::findOrFail($attributes->subscriber_id);
        $point = Point::findOrFail($attributes->point_id);
        // create report
        $support_message = "
                تم رفض طلب الصيانة من النوع: {$attributes->maintenance_request_type}
                 للمشترك رقم {$subscriber->subscriber_number}
                 المرسل من النقطة{$point->user->username}.";

        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'subscriber_id' => $subscriber->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount'    => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);

        $support_request->status = RequestStatusEnum::REJECTED->value;
        $support_request->update();
    }

    public function acceptTransfer(SupportRequest $support_request)
    {
        $attributes = json_decode($support_request->attributes);
        $subscriber = Subscriber::findOrFail($attributes->subscriber_id);
        $point = Point::findOrFail($attributes->point_id);

        $support_message = "
        تم قبول طلب الدعم من نوع نقل منزل
         للمشترك رقم {$subscriber->subscriber_number}
         المرسل من النقطة{$point->user->username}.";

        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'subscriber_id' => $subscriber->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount'    => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);

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
        $attributes = json_decode($support_request->attributes);
        $subscriber = Subscriber::findOrFail($attributes->subscriber_id);
        $point = Point::findOrFail($attributes->point_id);

        $support_message = "
        تم رفض طلب الدعم من نوع نقل منزل
         للمشترك رقم {$subscriber->subscriber_number}
         المرسل من النقطة{$point->user->username}.";

        Report::create([
            'point_id' => $point->id,
            'user_id'  => Auth::user()->id,
            'subscriber_id' => $subscriber->id,
            'report' => $support_message,
            // 'on_him' => 0,
            // 'to_him' => 0,
            'amount'    => 0,
            'pre_account' => $point->account,
            'account' => $point->account,
            'type' => ReportTypeEnum::SUPPORT->value,
        ]);

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
