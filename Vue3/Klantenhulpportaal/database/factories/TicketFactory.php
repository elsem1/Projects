<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;


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

        return [
            'title' => fake()->sentence(15),
            'content' => $content,
            'status_id' => 1,
        ];
    }

    public function withCategories()
    {
        return $this->afterCreating(function (Ticket $ticket) {
            $count = (rand(1, 100) <= 70) ? 1 : ((rand(1, 100) <= 90) ? 2 : 3);
            $categories = Category::inRandomOrder()->limit($count)->pluck('id');
            $ticket->categories()->attach($categories);
        });
    }
}
