<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SupportRequestTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Notification;
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

    public function acceptNewSubscriber()
    {
    }

    public function acceptSwitchCompany()
    {
    }

    public function rejectNewSubscriber()
    {
    }

    public function rejectSwitchCompany()
    {
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
