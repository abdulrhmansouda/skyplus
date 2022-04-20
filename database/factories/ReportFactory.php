<?php

namespace Database\Factories;

use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'point_id' => rand(1,Point::all()->count()),
            'report' => $this->faker->sentence,
            'note' => $this->faker->sentence,
            'on_him' => $this->faker->numberBetween(0,100),
            'to_him' => $this->faker->numberBetween(0,100),
            'pre_account' => $this->faker->numberBetween(0,100000),
            'created_at' => $this->faker->date(),
            // 'updated_at'
        ];
    }
}
