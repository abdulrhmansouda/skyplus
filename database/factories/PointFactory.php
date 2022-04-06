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
                // 'name' => $this->faker->name,
                'address' => $this->faker->address,
                'account' => $this->faker->numberBetween(),
                'tc' => $this->faker->phoneNumber,
                'description' => $this->faker->paragraph,
                'borrowingIsAllowed' => $this->faker->boolean,
                'phone' => $this->faker->phoneNumber,
        ];
    }
}