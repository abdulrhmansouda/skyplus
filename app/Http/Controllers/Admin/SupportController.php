<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\SupportRequest;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    

    public function index(){

        // dd(SupportRequest::all());
        $support_notification = Notification::firstOrFail();
        $support_notification->support_notification = false;
        $support_notification->update();
        
        $requests = SupportRequest::latest();
        return view('admin.pages.support-requests',[
            'requests' => $requests->paginate(10),
        ]);
    }

    public function accept_request(){
dd('accept');
    }

    public function reject_request(Request $request){
        // dd($request->all());
        $request->validate([
            'request_id' => [ 'required' , 'exists:support_requests,id' ,],
        ]);

        $request = SupportRequest::findOrFail($request->request_id);

        $request->status = 'rejected';
        $request->update();

        session()->flash('success','تم رفض الطلب بنجاح');

        return redirect()->back();

    }

}
