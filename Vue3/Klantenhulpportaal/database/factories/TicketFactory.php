<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        $content = fake()->randomElement([
            fake()->paragraph(),
            fake()->paragraphs(fake()->numberBetween(2, 6), true),
            fake()->text(255),
        ]);
        $created_by = User::where('is_admin', 0)->inRandomOrder()->value('id');
        $handled_by = User::where('is_admin', 1)->inRandomOrder()->value('id');

        $status_id = 1;

        return [
            'title' => fake()->sentence(15),
            'content' => $content,
            'status_id' => 1,
            'created_by' => $created_by,
            'handled_by' => $handled_by,
        ];
    }
}
