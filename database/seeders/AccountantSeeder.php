<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Accountant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Accountant::factory(1)->create([
            'user_id' => User::factory(1)->create(['username' => 'accountant', 'role' => UserRoleEnum::ACCOUNTANT->value])->first()->id,
        ]);
    }
}
