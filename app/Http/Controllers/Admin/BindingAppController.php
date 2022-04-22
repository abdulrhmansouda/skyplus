<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectSetting;
use Illuminate\Http\Request;

class BindingAppController extends Controller
{
    public function index(){

        // dd(ProjectSetting::first()->bot_username);
        return view('admin.pages.setting-binding-app',[
            'settings' => ProjectSetting::first(),
        ]);
    }

    public function update(Request $request){
        $set = ProjectSetting::first();
        $set->bot_username = $request->bot_username;
        $set->bot_token = $request->bot_token;
        $set->chat_id = $request->chat_id;

        $set->update();

        session()->flash('success','تم تعديل اعدادات الربط بنجاح');

        return redirect()->back();

    }
}
