<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'author_id' => Author::factory(),
        'title' => fake()->words(),
        'publisher' => fake()->company(),
        'year' => fake()->year(),
        'genre' => fake()->word(),
        'edition' => fake()->numberBetween(1,10)
        ];
    }
}
