<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        ->count(10)
        ->hasPoint(1)
        ->create(['role'=>'point']);
    //     Admin::factory(10)->create([
    //         'user_id' => User::factory(10)->create(['role' => 'admin'])->first()->id,
    //     ]);

    //     Point::factory(10)->create([
    //         'user_id' => User::factory(10)->create(['role' => 'point'])->first()->id,
    //     ]);
    }
}
