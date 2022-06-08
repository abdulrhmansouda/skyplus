<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoxCash>
 */
class BoxCashFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'report' => $this->faker->sentence,
            'note' => $this->faker->sentence,
            'account' => $this->faker->numberBetween(0,100000),
            'pre_account' => $this->faker->numberBetween(0,100000),
            'transaction_type'  => rand(0,1),
            'created_at' => $this->faker->date(),
        ];
    }
}
