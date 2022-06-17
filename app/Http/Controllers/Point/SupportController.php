<?php

namespace App\Http\Controllers\Point;

use App\Enums\RequestStatusEnum;
use App\Enums\SupportRequestTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Point;
use App\Models\SupportNewSubscriberRequest;
use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupportController extends Controller
{


    public function index()
    {
        return view('point.pages.support');
    }
    
    public function newSubscriberRequest(Request $request)
    {
        $request->validate([
            'name'              => ['required', 'string', 'between:2,100'],
            'phone'             => ['required', 'string', 'between:2,100'],
            'address'           => ['required', 'string', 'between:2,1000'],
            'subscription_type' => ['required', 'string'],
            'note'              => ['nullable', 'string', 'between:2,1000'],
        ]);

        $attributes['subscription_type'] = $request->subscription_type;

        $point = Point::findOrFail(Auth::user()->point->id);

        SupportNewSubscriberRequest::create([
            'point_id'              => $point->id,
            'subscriber_name'       => $request->name,
            'subscriber_phone'      => $request->phone,
            'subscriber_address'    => $request->address,
            'note'                  => $request->note,
            'type'                  => SupportRequestTypeEnum::NEW_SUBSCRIBER->value,
            'status'                => RequestStatusEnum::WAINTING,
            'attributes'            => json_encode($attributes),
        ]);

        $support_notification = Notification::first();
        $support_notification->support_new_subscriber_notification = true;
        $support_notification->update();

        session()->flash('success', 'تم تسجيل طلبكم بنجاح');

        return redirect()->back();
    }

    public function switchCompanyRequest(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'between:2,100'],
            'phone'     => ['required', 'string', 'between:2,100'],
            'address'   => ['required', 'string', 'between:2,1000'],
            'note'      => ['nullable', 'string', 'between:2,1000'],
        ]);

        $point = Point::findOrFail(Auth::user()->point->id);

        SupportNewSubscriberRequest::create([
            'point_id'              => $point->id,
            'subscriber_name'       => $request->name,
            'subscriber_phone'      => $request->phone,
            'subscriber_address'    => $request->address,
            'note'                  => $request->note,
            'type'                  => SupportRequestTypeEnum::SWITCH_COMPANY->value,
            'status'                => RequestStatusEnum::WAINTING,
        ]);

        $support_notification = Notification::first();
        $support_notification->support_new_subscriber_notification = true;
        $support_notification->update();

        session()->flash('success', 'تم تسجيل طلبكم بنجاح');

        return redirect()->back();
    }
}
