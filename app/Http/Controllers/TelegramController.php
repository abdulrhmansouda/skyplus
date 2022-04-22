<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public static function chargeMessage($message){

            // $request->validate([
            //     'name' => 'required',
            //     'message' => 'required',
            // ]);
            // $text ="<strong>Name: </strong>\n"
            // ."$request->name\n"
            // ."<strong>Message: </strong>\n"
            // .$request->message;
            // // for($i=0;$i<100;$i++){
             Telegram::sendMessage([
                //'chat_id' => '-1001673250202',
                'chat_id' => '-1001686278067',
                // 'username' => 'abdulator0',
                'parse_mode' => 'HTML',
                'text' => $message,
            ]);
    
    }
}
