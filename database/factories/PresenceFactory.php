<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->firstOrFail(),
            'date' => fake()->date(),
            'eat_midday_at_home' => fake()->boolean(),
            'eat_evening_at_home' => fake()->boolean(),
            'sleep_at_home' => fake()->boolean(),
        ];
    }
}
