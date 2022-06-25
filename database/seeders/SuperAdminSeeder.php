<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::factory(1)->create([
            'user_id' => User::factory(1)->create(['username' => 'skyplus', 'role' => UserRoleEnum::SUPER_ADMIN->value])->first()->id,
        ]);

        // SuperAdmin::factory(1)->create([
        //     'user_id' => User::factory(1)->create(['username' => 'skyplus1', 'role' => UserRoleEnum::SUPER_ADMIN->value])->first()->id,
        // ]);
    }
}
