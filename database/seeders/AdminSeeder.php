<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(1)->create([
            'user_id' => User::factory(1)->create(['username' => 'admin', 'role' => UserRole::ADMIN->value])->first()->id,
        ]);
        
        User::factory()
        ->count(10)
        ->hasAdmin(1)
        ->create(['role' => UserRole::ADMIN->value]);
    }
}
