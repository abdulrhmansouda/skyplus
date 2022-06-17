<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use App\Models\Point;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Point::factory(1)->create([
            'user_id' => User::factory(1)->create([
                'username'                 => 'point',
                'role'                    => UserRoleEnum::POINT->value,
            ])->first()->id,
            'status'                  => UserStatusEnum::ACTIVE->value,
        ]);

        User::factory()
            ->count(10)
            ->hasPoint(1)
            // ->hasReports(10)
            ->create(['role' => UserRoleEnum::POINT->value]);
    }
}
