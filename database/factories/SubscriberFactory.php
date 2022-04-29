<?php

namespace Database\Factories;

// use Carbon\Carbon;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $date0 = $this->faker->date; 
        $date = new Carbon($date0);
        $date1 = new Carbon($date0);
        $date1 = $date1->addMonth();
        // $date = Carbon::now()->addMonth();
        return [
            'name' => $this->faker->name,
            't_c' => $this->faker->numberBetween(10000000000,21474831641),
            'phone' => $this->faker->phoneNumber,
            'sub_id' => $this->faker->numberBetween(),
            'sub_username' => $this->faker->unique()->userName."@icenet",
            'subscriber_number' => $this->faker->numberBetween(10000000000,21474831641),
            'mother' => $this->faker->name,
            'address' => $this->faker->address,
            'installation_address' => $this->faker->address,
            'mission_executor' => $this->faker->name,
            'status' => 'deactive',
            'package_start' => $date,
            'package_end' => $date1,
        ];


    }
}
