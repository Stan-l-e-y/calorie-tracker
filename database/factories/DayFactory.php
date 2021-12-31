<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'weight' => $this->faker->randomFloat(2, 100, 200),
            'calories' => $this->faker->randomFloat(2, 1000, 3000),
            'user_id' => 1
        ];
    }
}
