<?php

namespace Database\Seeders;

use App\Models\TelegramBot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TelegramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TelegramBot::create([
        //     'name' => 'مجموعة شحن المشتركين',
        //     'bot_token' => '5108071797:AAG6GINlNe8O7115o-GfvJQgt06-BzbqreM',
        //     'chat_id' => '-1001686278067',
        // ]);
        // TelegramBot::create([
        //     'name' => 'مجموعة الصيانة',
        //     'bot_token' => '5356853807:AAFB7eoGMlHrHf475OroELKItScAd-bzEFg',
        //     'chat_id' => '-1001509295078',
        // ]);

        // TelegramBot::create([
        //     'name' => 'مجموعة نقل المنزل',
        //     'bot_token' => '5340016018:AAET9FIQkoxR2E1L5byJgJK7sG1AZk2YiXE',
        //     'chat_id' => '-1001346115569',
        // ]);

        // TelegramBot::create([
        //     'name' => 'مجموعة المشتركين الجدد',
        //     'bot_token' => '5371646618:AAEnJ-pg2eOfI4yxvsfzA9C9_JXMZM3DDsY',
        //     'chat_id' => '-643108203',
        // ]);
        TelegramBot::create([
            'name' => 'مجموعة شحن المشتركين',
            'bot_token' => 'token1',
            'chat_id' => 'chat_id1',
        ]);
        TelegramBot::create([
            'name' => 'مجموعة الصيانة',
            'bot_token' => 'token2',
            'chat_id' => 'chat_id2',
        ]);

        TelegramBot::create([
            'name' => 'مجموعة نقل المنزل',
            'bot_token' => 'token3',
            'chat_id' => 'chat_id3',
        ]);

        TelegramBot::create([
            'name' => 'مجموعة المشتركين الجدد',
            'bot_token' => 'token4',
            'chat_id' => 'chat_id4',
        ]);
    }
}
