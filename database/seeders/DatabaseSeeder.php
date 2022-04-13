<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Package;
use App\Models\Point;
use App\Models\ProjectSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Point::factory(1)->create([
            'user_id' => User::factory(1)->create(['username' => 'point', 'role' => 'point'])->first()->id,
        ]);

        ProjectSetting::create([
            'bot_username' => 'grouupp_bot',
            'bot_token' => '5108071797:AAG6GINlNe8O7115o-GfvJQgt06-BzbqreM',
            'chat_id' => '-1001686278067',
        ]);

        User::factory()
        ->count(10)
        ->hasPoint(1)
        ->create(['role'=>'point']);

        Package::factory()
        ->count(10)
        ->hasSubscribers(10)
        ->create();




    }
}
