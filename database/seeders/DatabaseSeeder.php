<?php

namespace Database\Seeders;

use App\Http\Controllers\SettingSocialController;
use App\Models\Admin;
use App\Models\Admin\Setting\Social;
use App\Models\Package;
use App\Models\Point;
use App\Models\ProjectSetting;
use App\Models\Report;
use App\Models\User;
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

        Admin::factory(1)->create([
            'user_id' => User::factory(1)->create(['username' => 'skyplus', 'role' => 'admin'])->first()->id,
        ]);

        Admin::factory(1)->create([
            'user_id' => User::factory(1)->create(['username' => 'skyplus1', 'role' => 'admin'])->first()->id,
        ]);

        Point::factory(1)->create([
            'user_id' => User::factory(1)->create(['username' => 'point', 'role' => 'point'])->first()->id,
        ]);

        User::factory()
            ->count(10)
            ->hasPoint(1)
            // ->hasReports(10)
            ->create(['role' => 'point']);

        Report::factory(10)->create();

        User::factory()
            ->count(10)
            ->hasAdmin(1)
            ->create(['role' => 'admin']);

        Package::factory()
            ->count(10)
            ->hasSubscribers(10)
            ->create();

        ProjectSetting::create([
            // 'bot_username' => 'grouupp_bot',
            // 'bot_token' => '5108071797:AAG6GINlNe8O7115o-GfvJQgt06-BzbqreM',
            // 'chat_id' => '-1001686278067',

            'maximum_amount_of_borrowing' => 0,
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
    }
}
