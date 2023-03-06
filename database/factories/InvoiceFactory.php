<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->bothify('??####'),

            'user_id' => \App\Models\User::factory()->create()->id,

            'from_street_address' => fake()->streetAddress(),
            'from_city' => fake()->city(),
            'from_post_code' => fake()->postcode(),
            'from_country' => fake()->country(),

            'to_street_address' => fake()->streetAddress(),
            'to_city' => fake()->city(),
            'to_post_code' => fake()->postcode(),
            'to_country' => fake()->country(),

            'description' => fake()->paragraph(),
            'client_name' => fake()->name(),
            'client_email' => fake()->email(),
            'payment_terms' => fake()->numberBetween(1, 30),
            'status' => fake()->randomElement(\App\Models\Invoice::STATUSES),
            'payment_due' => fake()->dateTimeBetween('+1 week', '30 days'),
            'total' => fake()->randomFloat(2, 0, 1000),
        ];
    }
}
