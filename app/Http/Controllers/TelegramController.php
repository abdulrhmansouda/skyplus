<?php

namespace App\Http\Controllers;

use App\Models\TelegramBot;
use Illuminate\Http\Request;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{

    // public static function updatedActivity(){

    //     $telegram = new Api('5356853807:AAFB7eoGMlHrHf475OroELKItScAd-bzEFg');
    //     $activity = $telegram->getUpdates();
    //     dd($activity);
    // }

    // public static function test($message){
    //     $telegram = new Api('5108071797:AAG6GINlNe8O7115o-GfvJQgt06-BzbqreM',true);

    //     $resopose = $telegram->getMe();
    //     // ->setAsyncRequest(true)
    //     // dd($telegram);
    //     $telegram->sendMessage([
    //         //'chat_id' => '-1001673250202',
    //         'chat_id' => '-1001686278067',
    //         // 'username' => 'abdulator0',
    //         'parse_mode' => 'HTML',
    //         'text' => $message,
    //     ]);
    //     // dd(1);
    // }

    public static function chargeMessage($message)
    {
        // dd(1);
        $bot = TelegramBot::findOrFail(1);
        $telegram = new Api($bot->bot_token, true);

        $telegram->sendMessage([
            'chat_id' => $bot->chat_id,
            'parse_mode' => 'HTML',
            'text' => $message,
        ]);
    }
    public static function maintenanceMessage($message)
    {
        // dd(1);
        $bot = TelegramBot::findOrFail(2);
        $telegram = new Api($bot->bot_token, true);

        $telegram->sendMessage([
            'chat_id' => $bot->chat_id,
            'parse_mode' => 'HTML',
            'text' => $message,
        ]);
    }
}
