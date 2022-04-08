<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Package;
use App\Models\Point;
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

        User::factory()
        ->count(100)
        ->hasPoint(1)
        ->create(['role'=>'point']);

        Package::factory()
        ->count(10)
        ->hasSubscribers(10)
        ->create();
    }
}
