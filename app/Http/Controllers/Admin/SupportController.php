<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RequestStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\SupportRequest;

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

    public function accept_request()
    {
        dd('accept');
    }

    public function reject_request(SupportRequest $support_request)
    {
        $support_request->status = RequestStatusEnum::REJECTED->value;
        $support_request->update();
        session()->flash('success', 'تم رفض الطلب بنجاح');

        return redirect()->back();
    }
}
