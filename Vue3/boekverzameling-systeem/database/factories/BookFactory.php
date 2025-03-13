<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
use App\Models\Review;
use App\Models\Book;

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
    protected static $genres = [
        'Fiction',
        'Non-Fiction',
        'Science Fiction',
        'Mystery',
        'Thriller',
        'Romance',
        'Fantasy',
        'Horror',
        'Biography',
        'History',
    ];
    public function definition(): array
    {
        return [
            'author_id' => 1,
            'title' => fake()->sentence(4, true),
            'publisher' => fake()->company(),
            'year' => fake()->year(),
            'genre' => $this->getRandomGenre(),
            'edition' => fake()->numberBetween(1, 10)
        ];
    }





    protected function getRandomGenre(): string
    {
        return static::$genres[array_rand(static::$genres)];
    }

}
