<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Point>
 */
class PointFactory extends Factory
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
                'address' => $this->faker->address,
                'account' => $this->faker->numberBetween(0,101010),
                't_c' => $this->faker->numberBetween(10000000000,21474831641),
                'commission' => $this->faker->randomFloat(null,0,30),
                'borrowing_is_allowed' => $this->faker->boolean,
                'phone' => $this->faker->phoneNumber,
                'daily_profit' => $this->faker->numberBetween(0,1000),
        ];
    }
}