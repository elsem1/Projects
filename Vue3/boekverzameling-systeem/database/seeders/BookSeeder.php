<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Review;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory()->count(45)->create();
        Review::factory()->count(300)->create();

        Book::factory()
            ->count(100)
            ->withAuthor()
            ->withReview(1,4)
            ->create();


    }
}
