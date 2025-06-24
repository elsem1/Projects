<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $content = fake()->randomElement([
            fake()->paragraph(),
            fake()->paragraphs(fake()->numberBetween(2, 6), true),
            fake()->text(255),
        ]);

        return [
            'content' => $content,
            'ticket_id' => Ticket::factory(),
            'user_id' => User::factory(),

        ];
    }
};
