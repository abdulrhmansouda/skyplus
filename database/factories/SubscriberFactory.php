<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Subscriber>
 */
class SubscriberFactory extends Factory
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
            't_c' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'sub_id' => $this->faker->numberBetween(),
            'subscriber_number' => $this->faker->numberBetween(1000000000,2147483641),
            'mother' => $this->faker->name,
            'address' => $this->faker->address,
            'installation_address' => $this->faker->address,
        ];


    }
}
