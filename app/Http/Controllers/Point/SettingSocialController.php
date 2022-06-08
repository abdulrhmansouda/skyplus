<?php

namespace App\Http\Controllers\Point;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting\Social;
use Illuminate\Http\Request;

class SettingSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Social::first());
        return view('admin.pages.setting-social',[
            'social' => Social::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'website' => ['nullable' ,'string' ,'max:1000',],
            'phone1' => ['nullable' ,'string' ,'max:100',],
            'phone2' => ['nullable' ,'string' ,'max:100',],
            'email' => ['nullable' ,'string' ,'max:100',],
            'whatsapp' => ['nullable' ,'string' ,'max:100',],
            'telegram_name' => ['nullable' ,'string' ,'max:100',],
            'telegram_url' => ['nullable' ,'string' ,'max:100',],
            'facebook_name' => ['nullable' ,'string' ,'max:100',],
            'facebook_url' => ['nullable' ,'string' ,'max:100',],
            'address' => ['nullable' ,'string' ,'max:1000',],
        ]);

        $social = Social::first();

        $social->website = $request->website;
        $social->phone1 = $request->phone1;
        $social->phone2 = $request->phone2;
        $social->email = $request->email;
        $social->whatsapp = $request->whatsapp;
        $social->telegram_name = $request->telegram_name;
        $social->telegram_url = $request->telegram_url;
        $social->facebook_name = $request->facebook_name;
        $social->facebook_url = $request->facebook_url;
        $social->address = $request->address;

        $social->update();

        session()->flash('success','تم تعديل معلومات التواصل بنجاح ');


        return redirect()->back();
    }

}
