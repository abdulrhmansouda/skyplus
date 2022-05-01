<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TelegramBot;
use Illuminate\Http\Request;

class BindingTelegramController extends Controller
{
    public function index(){
        return view('admin.pages.setting-binding-telegram',[
            'settings' => TelegramBot::findOrFail(1),
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'bot_token' => [ 'required' ],
            'chat_id' => [ 'required' ],
        ]);
        $bot = TelegramBot::findOrFail(1);
        $bot->bot_token = $request->bot_token;
        $bot->chat_id = $request->chat_id;

        $bot->update();

        session()->flash('success','تم تعديل اعدادات الربط جروب شحن المشتركين بنجاح');

        return redirect()->back();

    }
}