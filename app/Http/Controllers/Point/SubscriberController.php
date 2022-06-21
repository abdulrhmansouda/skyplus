<?php

namespace App\Http\Controllers\Point;

use App\Enums\ReportTypeEnum;
use App\Enums\RequestStatusEnum;
use App\Enums\SupportRequestTypeEnum;
use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TelegramController;
use App\Http\Requests\Point\ChargeSubscriberRequest;
use App\Http\Requests\Point\SwitchPackageAndChargeSubscriberRequest;
use App\Http\Requests\Point\UnChargeSubscriberRequest;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Point;
use App\Models\Report;
use App\Models\Subscriber;
use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $s = $request->s ?? '';

        $sub = Subscriber::where('t_c', "$s")
            ->orWhere('subscriber_number', "$s")
            ->orWhere('phone', "$s")->first();

        $reports = Report::where('point_id', Auth::user()->point->id)
            ->whereDate('created_at', now()->format('Y-m-d'))->get();

        $packages = Package::active()->where('id', '<>', $sub?->package_id)->get();

        return view('point.pages.subscribers', [
            'sub' => $sub,
            'reports' => $reports,
            'packages' => $packages,
            'search' => $s,
        ]);
    }


    public function charge(ChargeSubscriberRequest $request, $id)
    {
        $sub = Subscriber::findOrFail($id);
        $package = $sub->package;

        if ($package->status === UserStatusEnum::CLOSED->value) {
            session()->flash('error', 'هذه الباقة لم تعد متاحة الرجاء ترقية الباقة');
            return redirect()->back();
        }

        $point = Auth::user()->point;

        $months = $request->months;
        $amount = $months * $package->price;
        $profit = ($point->charge_commission / 100) * $amount;

        // موضوع الدين
        $maximum_debt_limit = $point->maximum_debt_limit;
        if ($amount > $point->account + $maximum_debt_limit + $profit) {
            session()->flash('error', 'لا يوجد رصيد كافي لتنفيذ عملية الشحن هذه');
            return redirect()->back();
        }
        // انتهاء موضوع الدين

        $message = "تم شحن/تفعيل الباقة $package->name للمشترك رقم $sub->subscriber_number لمدة $months أشهر و تم اقطاع مبلغ $amount من الرصيد.";
        $commission_message = "تم اضافة المبلغ $profit لرصيد النقطة {$point->user->username} عمولة شحن رصيد للمشترك {$sub->subscriber_number} .";
        $telegram_message = "
            تم تسديد فاتورة من نقطة البيع  {$point->user->username}
            للمشترك {$sub->sub_username}
            عدد الفواتير : {$months}
            المبلغ المدفوع: {$amount}
          ({$package->name}) + ({$package->price})
          
          http://192.168.106.24/issmanager/paket_uzat&{$sub->sub_id}
          
          ✅✅✅✅✅✅✅✅✅✅✅✅";

        // العمليات المهمة جداً
        DB::transaction(function () use ($point, $amount, $profit, $sub, $months, $message, $commission_message, $telegram_message) {

            //make a report
            Report::create([
                'point_id' => $point->id,
                'subscriber_id' => $sub->id,
                'report' => $message,
                // 'on_him' => $amount,
                // 'to_him' => 0,
                'amount' => -1 * $amount,
                'pre_account' => $point->account,
                'account' => $point->account - $amount,
                'type' => ReportTypeEnum::CHARGE_SUBSCRIBER->value,
            ]);

            $point->takeFromAccount($amount);

            Report::create([
                'point_id' => $point->id,
                // 'subscriber_id' => $sub->id,
                'report' => $commission_message,
                // 'on_him' => 0,
                // 'to_him' => $profit,
                'amount' => $profit,
                'pre_account' => $point->account,
                'account' => $point->account + $profit,
                'type' => ReportTypeEnum::COMMISSION->value,
            ]);
            $point->addToAccount($profit);

            $sub->payMonths($months);

            // make a invoice
            Invoice::create([
                'point_id' => $point->id,
                'subscriber_id' => $sub->id,
                'amount' => $amount,
                'months' => $months,
            ]);

            //send a massege to telegram
            TelegramController::chargeMessage($telegram_message);

            session()->flash('success', ' تم دفع الفاتورة بنجاح');
        }, 5);

        return redirect()->back();
    }

    public function uncharge(UnChargeSubscriberRequest $request, $id)
    {

        $sub = Subscriber::findOrFail($id);
        $package = $sub->package;
        $point = Auth::user()->point;

        $months = $request->months;
        $amount = $months * $package->price;
        $profit = ($point->charge_commission / 100) * $amount;

        // الغاء التسديد

        // عدد الفواتير التي تم دفعها للمشترك $sub->id من النقطة $point->id قبل انتهاء اليوم
        $invoice_month = Invoice::where('subscriber_id', $sub->id)
            ->where('point_id', $point->id)
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->sum('months') ?? 0;

        // التأكد من ان الفواتير التي يريد الغاءها  أقل او تساوي الفواتير المدفوعة اليوم
        if ($months > $invoice_month) {
            session()->flash('error', 'انت لم تقم بدفع هذه الفاتور تأكد من المعلومات');
            return redirect()->back();
        }

        $message = "تم ألغاء شحن/تفعيل الباقة {$package->name}
         للمشترك رقم {$sub->subscriber_number}
          لمدة $months أشهر و تم الغاء اقطاع مبلغ $amount من الرصيد و الغاء أضافة مبلغ $profit .";
        $commission_message = "تم الغاء اضافة المبلغ $profit لرصيد النقطة {$point->user->username} عمولة شحن رصيد للمشترك {$sub->subscriber_number} .";


        $telegram_message = "
            تم الغاء فاتورة من نقطة البيع  {$point->user->username}
             للمشترك {$sub->sub_username}
            عدد  الفواتير: -{$months}
             المبلغ المرتجع : -{$amount}
            ({$package->name}) - ({$package->price})

            http://192.168.106.24/issmanager/paket_uzat&{$sub->sub_id}

            ❌❌❌❌❌❌❌❌❌❌❌❌";

        //العمليات المهمة جداً
        DB::transaction(function () use ($point, $sub, $amount, $profit, $months, $message, $commission_message, $telegram_message) {


            //make a report
            Report::create([
                'point_id' => $point->id,
                'subscriber_id' => $sub->id,
                'report' =>  $commission_message,
                // 'on_him' => 0,
                // 'to_him' => -1 * $profit,
                'amount' => -1 * $profit,
                'pre_account' => $point->account,
                'account' => $point->account  - $profit,
                'type' => ReportTypeEnum::COMMISSION->value,
            ]);

            $point->takeFromAccount($profit);

            Report::create([
                'point_id' => $point->id,
                'subscriber_id' => $sub->id,
                'report' =>  $message,
                // 'on_him' => -1 * $amount,
                // 'to_him' => 0,
                'amount' => $amount,
                'pre_account' => $point->account,
                'account' => $point->account + $amount,
                'type' => ReportTypeEnum::CHARGE_SUBSCRIBER->value,
            ]);

            $point->addToAccount($amount);


            $sub->cancelPayMonths($months);

            // make a invoice
            Invoice::create([
                'point_id' => $point->id,
                'subscriber_id' => $sub->id,
                'amount' => -1 * $amount,
                'months' => -1 * $months,
            ]);

            //send a massege to telegram
            TelegramController::chargeMessage($telegram_message);

            session()->flash('success', ' تم الغاء دفع الفاتورة بنجاح');
        }, 5);


        return redirect()->back();
    }

    public function switchPackageAndChargeRequest(SwitchPackageAndChargeSubscriberRequest $request, $id)
    {
        $sub = Subscriber::findOrFail($id);
        $attributes['subscriber_id'] = $id;
        $pre_package = $sub->package;
        $attributes['pre_package_id'] = $pre_package->id;
        if ($pre_package->id === $request->package_id) {
            session()->flash('error', 'هذه هي نفس باقة المشترك بالفعل');
            return redirect()->back();
        }

        $attributes['pre_package_id'] = $pre_package->id;
        $new_package = Package::findOrFail($request->package_id);
        $attributes['new_package_id'] = $new_package->id;
        $point = Auth::user()->point;
        $attributes['point_id'] = $point->id;

        $months = $request->months;
        $attributes['months'] = $months;
        $amount = $months * $new_package->price;
        $attributes['amount'] = $amount;
        $profit = ($point->charge_commission / 100) * $amount;
        $attributes['profit'] = $profit;

        // موضوع الدين
        $maximum_debt_limit = $point->maximum_debt_limit;
        if ($amount > $point->account + $maximum_debt_limit + $profit) {
            session()->flash('error', 'لا يوجد رصيد كافي لتنفيذ عملية الشحن هذه');
            return redirect()->back();
        }
        // انتهاء موضوع الدين
        //
        $support_message = "
تم تسجيل طلب تغير الباقة للمشترك رقم {$sub->subscriber_number}
 من الباقة {$pre_package->name}
  ال الباقة {$new_package->name}
  المرسل من النقطة{$point->user->username}.";

        $charge_message = "تم تسجيل طلب شحن/تفعيل الباقة {$new_package->name}
 للمشترك رقم {$sub->subscriber_number}
  لمدة {$months}
   أشهر و تم اقطاع مبلغ {$amount}
    من الرصيد
    على انه سيتم اعادة المبلغ في حال رفض الطلب.";

        $commission_message = "تم اضافة المبلغ {$profit}
 لرصيد النقطة {$point->user->username}
  عمولة شحن رصيد للمشترك {$sub->subscriber_number}
   على انه سيتم استرداد العمولة في حال رفض الطلب.";


        //
        // العمليات المهمة جداً
        DB::transaction(function () use ($point, $amount, $profit, $sub, $attributes, $support_message, $charge_message, $commission_message) {

            SupportRequest::create([
                'point_id'              => $point->id,
                'subscriber_id'         => $sub->id,
                'type'                  => SupportRequestTypeEnum::SWITCH_PACKAGE,
                'status'                => RequestStatusEnum::WAINTING->value,
                'attributes'            => json_encode($attributes),
            ]);

            //make a report
            Report::create([
                'point_id' => $point->id,
                // 'user_id'  => Auth::user()->id,
                'subscriber_id' => $sub->id,
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
                // 'user_id'  => Auth::user()->id,
                'subscriber_id' => $sub->id,
                'report' => $charge_message,
                // 'on_him' => $amount,
                // 'to_him' => 0,
                'amount' => -1 * $amount,
                'pre_account' => $point->account,
                'account' => $point->account - $amount,
                'type' => ReportTypeEnum::CHARGE_SUBSCRIBER->value,
            ]);

            $point->takeFromAccount($amount);

            Report::create([
                'point_id' => $point->id,
                // 'user_id'  => Auth::user()->id,
                'subscriber_id' => $sub->id,
                'report' => $commission_message,
                // 'on_him' => 0,
                // 'to_him' => $profit,
                'amount' => $profit,
                'pre_account' => $point->account,
                'account' => $point->account + $profit,
                'type' => ReportTypeEnum::COMMISSION->value,
            ]);
            $point->addToAccount($profit);


            $support_notification = Notification::first();
            $support_notification->support_notification = true;
            $support_notification->update();

            session()->flash('success', 'تم تسجيل طلب تعديل الباقة بنجاح');
        }, 5);

        return redirect()->back();
    }

    public function maintenance(Request $request, Subscriber $subscriber)
    {
        $request->validate([
            'type' => ['required', Rule::in([SupportRequestTypeEnum::MAINTENANCE->value])],
            'maintenance_request_type' => ['required', 'string'],
            'note' => ['nullable', 'string', 'between:2,1000'],
        ]);
        $point = Point::findOrFail(Auth::user()->point->id);

        $attributes['maintenance_request_type'] = $request->maintenance_request_type;
        $attributes['point_id'] = $point->id;
        $attributes['subscriber_id'] = $subscriber->id;



        DB::transaction(function () use ($point, $subscriber, $attributes, $request) {
            SupportRequest::create([
                'point_id'              => $point->id,
                'subscriber_id'         => $subscriber->id,
                'type'                  => $request->type,
                'status'                => RequestStatusEnum::WAINTING->value,
                'attributes'            => json_encode($attributes),
                'note'                  => $request->note,
            ]);

            $support_notification = Notification::firstOrFail();
            $support_notification->support_notification = true;
            $support_notification->update();

            session()->flash('success', 'تم تسجيل طلبكم بنجاح');
        });
        return redirect()->back();
    }

    public function transfer(Request $request, Subscriber $subscriber)
    {
        $request->validate([
            'type' => ['required', Rule::in([SupportRequestTypeEnum::MAINTENANCE->value, SupportRequestTypeEnum::TRANSFER->value])],
            'note' => ['nullable', 'string', 'between:2,1000'],
        ]);
        $point = Point::findOrFail(Auth::user()->point->id);

        $attributes['maintenance_request_type'] = 'نقل المنزل';
        $attributes['point_id'] = $point->id;
        $attributes['subscriber_id'] = $subscriber->id;



        DB::transaction(function () use ($point, $subscriber, $attributes, $request) {
            SupportRequest::create([
                'point_id'              => $point->id,
                'subscriber_id'         => $subscriber->id,
                'type'                  => $request->type,
                'status'                => RequestStatusEnum::WAINTING->value,
                'attributes'            => json_encode($attributes),
                'note'                  => $request->note,
            ]);

            $support_notification = Notification::firstOrFail();
            $support_notification->support_notification = true;
            $support_notification->update();

            session()->flash('success', 'تم تسجيل طلبكم بنجاح');
        });
        return redirect()->back();
    }
}
