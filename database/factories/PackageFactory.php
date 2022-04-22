<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $date = $this->faker->date;
        // $carbon0 = new Carbon($date);
        // $carbon1 = new Carbon ($date);
        // $carbon1 = $carbon1->addMonths($this->faker->numberBetween(1,12));
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(1,100),
            // 'start' => $carbon0,
            // 'end' => $carbon1,
        ];
    }
}
