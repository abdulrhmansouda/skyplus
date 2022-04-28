<?php

namespace App\Http\Controllers\Point;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupportController extends Controller
{
    

    public function index(){

        return view('point.pages.support');
    }

    public function support_request(Request $request){
        // dd(1);
        $request->validate([
            'name' => [ 'required' , 'string' , 'between:2,100'],
            'phone' => [ 'required' , 'string' , 'between:2,100'],
            'address' => [ 'required' , 'string' , 'between:2,1000'],
            'note' => [ 'nullable' , 'string' , 'between:2,1000'],
            'type' => [ 'required' , Rule::in([ 'new_installation' , 'switch' , 'maintenance' ])],
        ]);
        // dd(1);

        $point = Point::findOrFail(Auth::user()->point->id);

        SupportRequest::create([
            'point_id' => $point->id,
            'subscriber_name' => $request->name,
            'subscriber_phone' => $request->phone,
            'subscriber_address' => $request->address,
            'note' => $request->note,
            'type' => $request->type,
            'status' => 'waiting'
        ]);

        session()->flash('success','تم تسجيل طلبكم بنجاح');

        return redirect()->back();
    }


}
