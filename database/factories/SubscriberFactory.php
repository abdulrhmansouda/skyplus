<?php

namespace Database\Factories;

// use Carbon\Carbon;
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
            't_c' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'sub_id' => $this->faker->numberBetween(),
            'subscriber_number' => $this->faker->numberBetween(1000000000,2147483641),
            'mother' => $this->faker->name,
            'address' => $this->faker->address,
            'installation_address' => $this->faker->address,
            // 'subscribtion_date' => $this->faker->date,
            'package_start' => $date,
            'package_end' => $date1,
        ];


    }
}
