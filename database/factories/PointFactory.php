<?php

namespace Database\Factories;

use App\Enums\UserStatusEnum;
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
            'name'                    => $this->faker->name,
            'address'                 => $this->faker->address,
            'account'                 => $this->faker->numberBetween(0, 101010),
            't_c'                     => $this->faker->numberBetween(10000000000, 21474831641),
            'charge_commission'       => $this->faker->randomFloat(null, 0, 30),
            'new_commission'          => $this->faker->randomFloat(3, 0, 100),
            'switch_commission'       => $this->faker->randomFloat(3, 0, 100),
            // 'borrowing_is_allowed' => $this->faker->boolean,
            'status'                  => rand(1,3),
            'phone'                   => $this->faker->phoneNumber,
            'daily_profit'            => $this->faker->numberBetween(0, 1000),
            'maximum_debt_limit'      => $this->faker->numberBetween(0, 1000),
        ];
    }
}
