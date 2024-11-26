<?php

namespace Database\Factories;

use App\Models\Affiliates;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => (fake()->randomNumber(6) . '.' . fake()->randomNumber(2, true)),
            'date_commission' => fake()->dateTimeBetween('now', '+1 year'),
            'affiliates_id' => Affiliates::inRandomOrder()->first()->id
        ];
    }
}
