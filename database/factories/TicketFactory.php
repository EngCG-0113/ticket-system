<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['open','closed']);
        return [
            'status' => $status,
            'issue_headline' => $this->faker->sentence(),
            'issue_description' => $this->faker->paragraph(),
            'requested_by' => $this->faker->name(),
            'requested_date' => $this->faker->dateTimeBetween('-1 week', ''),
        ];
    }
}
