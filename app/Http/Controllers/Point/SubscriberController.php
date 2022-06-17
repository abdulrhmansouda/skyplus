<?php

namespace App\Http\Controllers\Point;

use App\Enums\ReportTypeEnum;
use App\Enums\RequestStatusEnum;
use App\Enums\SupportRequestTypeEnum;
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

        $packages = Package::where('id', '<>', $sub?->package_id)->get();

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
        $message_profit = "تم اضافة المبلغ $profit لرصيد النقطة {$point->user->username} عمولة شحن رصيد للمشترك {$sub->subscriber_number} .";
        $telegram_message = "
            تم تسديد فاتورة من نقطة البيع  {$point->user->username}
            للمشترك {$sub->sub_username}
            عدد الفواتير : {$months}
            المبلغ المدفوع: {$amount}
          ({$package->name}) + ({$package->price})
          
          http://192.168.106.24/issmanager/paket_uzat&{$sub->sub_id}
          
          ✅✅✅✅✅✅✅✅✅✅✅✅";

        // العمليات المهمة جداً
        DB::transaction(function () use ($point, $amount, $profit, $sub, $months, $message, $message_profit, $telegram_message) {
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
                'type' => ReportTypeEnum::CHARGE_SUBSCRIBER->value,
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

        $message = "تم ألغاء شحن/تفعيل الباقة $package->name للمشترك رقم $sub->subscriber_number لمدة $months أشهر و تم الغاء اقطاع مبلغ $amount من الرصيد و الغاء أضافة مبلغ $profit .";
        $message_profit = "تم الغاء اضافة المبلغ $profit لرصيد النقطة {$point->user->username} عمولة شحن رصيد للمشترك {$sub->subscriber_number} .";


        $telegram_message = "
            تم الغاء فاتورة من نقطة البيع  {$point->user->username}
             للمشترك {$sub->sub_username}
            عدد  الفواتير: -{$months}
             المبلغ المرتجع : -{$amount}
            ({$package->name}) - ({$package->price})

            http://192.168.106.24/issmanager/paket_uzat&{$sub->sub_id}

            ❌❌❌❌❌❌❌❌❌❌❌❌";

        //العمليات المهمة جداً
        DB::transaction(function () use ($point, $sub, $amount, $profit, $months, $message, $message_profit, $telegram_message) {

            $point->addToAccount($amount);
            $point->takeProfitFromAccount($profit);

            $sub->cancelPayMonths($months);

            //make a report
            Report::create([
                'point_id' => $point->id,
                'report' =>  $message,
                'on_him' => -1 * $amount,
                'to_him' => 0,
                'pre_account' => $point->account,
                'type' => ReportTypeEnum::CHARGE_SUBSCRIBER->value,
            ]);

            Report::create([
                'point_id' => $point->id,
                'report' =>  $message_profit,
                'on_him' => 0,
                'to_him' => -1 * $profit,
                'pre_account' => $point->account - 1 * $amount,
                'type' => ReportTypeEnum::COMMISSION->value,
            ]);

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
        $package = $sub->package;
        $attributes['pre_package_id'] = $package->id;
        if ($package->id === $request->package_id) {
            session()->flash('error', 'هذه هي نفس باقة المشترك بالفعل');
            return redirect()->back();
        }
        $attributes['pre_package_id'] = $package->id;
        $package = Package::findOrFail($request->package_id);
        $attributes['new_package_id'] = $package->id;
        $point = Auth::user()->point;
        $attributes['point_id'] = $point->id;

        $months = $request->months;
        $attributes['months'] = $months;
        $amount = $months * $package->price;
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

        // العمليات المهمة جداً
        DB::transaction(function () use ($point, $amount, $profit, $sub, $attributes) {
            $point->takeFromAccount($amount);
            $point->addProfitToAccount($profit);

            SupportRequest::create([
                'point_id'              => $point->id,
                'subscriber_id'         => $sub->id,
                'type'                  => SupportRequestTypeEnum::SWITCH_PACKAGE,
                'status'                => RequestStatusEnum::WAINTING->value,
                'attributes'            => json_encode($attributes),
            ]);

            $support_notification = Notification::first();
            $support_notification->support_notification = true;
            $support_notification->update();

            session()->flash('success', 'تم تسجيل طلب تعديل الباقة بنجاح');
        }, 5);

        return redirect()->back();
    }

    public function maintenance(Request $request, Subscriber $subscriber)
    {
        dd($request->all());
        $request->validate([
            'type' => ['required', Rule::in([SupportRequestTypeEnum::MAINTENANCE->value, SupportRequestTypeEnum::TRANSFER->value])],
            'maintenance_request_type' => [Rule::requiredIf($request->type === SupportRequestTypeEnum::MAINTENANCE->value), 'string'],
            'note' => ['nullable', 'string', 'between:2,1000'],
        ]);

        if ($request->type === SupportRequestTypeEnum::MAINTENANCE->value) {
            $attributes['maintenance_request_type'] = $request->maintenance_request_type;
            $attributes = json_encode($attributes);
        }

        $point = Point::findOrFail(Auth::user()->point->id);


        DB::transaction(function () use ($point, $subscriber, $attributes) {
            SupportRequest::create([
                'point_id'              => $point->id,
                'subscriber_id'         => $subscriber->id,
                'type'                  => SupportRequestTypeEnum::SWITCH_PACKAGE,
                'status'                => RequestStatusEnum::WAINTING->value,
                'attributes'            => $attributes,
            ]);

            $message = "
            طلب صيانة من نقطة البيع  {$point->user->username}
 
        للمشترك {$subscriber->sub_username}

        نوع الصيانة : انترنت ضعيف

        http://192.168.106.24/issmanager/kullanici_detay&{$subscriber->sub_id}

        🛠️⚙️🛠️⚙️🛠️🛠️⚙️🛠️⚙️🛠️🛠️⚙️🛠️⚙️🛠️
            ";

            TelegramController::maintenanceMessage($message);
            $support_notification = Notification::firstOrFail();
            $support_notification->support_notification = true;
            $support_notification->update();

            session()->flash('success', 'تم تسجيل طلبكم بنجاح');
        });
        return redirect()->back();
    }
}
