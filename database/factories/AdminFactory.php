<?php

namespace Database\Factories;

use App\Enums\UserStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            't_c' => $this->faker->numberBetween(10000000000,33333333333),  
            'phone' => $this->faker->phoneNumber,
            'status' => UserStatusEnum::ACTIVE->value,
        ];
    }
}
