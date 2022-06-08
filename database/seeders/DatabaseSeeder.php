<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Admin\Setting\Social;
use App\Models\BoxCash;
use App\Models\Notification;
use App\Models\Package;
use App\Models\ProjectSetting;
use App\Models\Report;
use App\Models\SuperAdmin;
use App\Models\TelegramBot;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            // UserSeeder::class,
            SuperAdminSeeder::class,
            AdminSeeder::class,
            AccountantSeeder::class,
            PointSeeder::class,
        ]);

        Report::factory(100)->create();
        // BoxCash::factory(100)->create();


        Package::factory()
            ->count(10)
            ->hasSubscribers(10)
            ->create();

        ProjectSetting::create([
            'maximum_amount_of_borrowing' => 0,
        ]);

        TelegramBot::create([
            // 'bot_username' => 'grouupp_bot',
            'type' => 'charge',
            'bot_token' => '5108071797:AAG6GINlNe8O7115o-GfvJQgt06-BzbqreM',
            'chat_id' => '-1001686278067',
        ]);
        TelegramBot::create([
            // 'bot_username' => 'grouupp_bot',
            'type' => 'support',
            'bot_token' => '5356853807:AAFB7eoGMlHrHf475OroELKItScAd-bzEFg',
            'chat_id' => '-1001509295078',
        ]);

        Social::create([
            'website' => 'https://www.skyplus.com',
            'phone1' => '0123456789',
            'phone2' => '0123456789',
            'email' => 'skyplus@gmail.com',
            'whatsapp' => '0123456789',
            'telegram_name' => '@skyplus',
            'telegram_url' => 'https://t.me/skyplus',
            'facebook_name' => 'skyplus',
            'facebook_url' => 'https://www.facebook.com/skyplus',
            'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero vitae voluptatum sequi deleniti itaque accusamus adipisci dolore atque tempora placeat error tempore distinctio similique sed deserunt, amet beatae cum ducimus.',
        ]);

        Notification::create([
            'support_notification' => true,
        ]);
    }
}
