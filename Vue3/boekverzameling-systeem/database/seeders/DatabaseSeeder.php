<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Book;
use App\Models\Author;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Maak 45 auteurs aan als deze er nog niet zijn
        if (Author::count() === 0) {
            $authors = Author::factory()->count(45)->create();
        } else {
            $authors = Author::all();
        }

        // Maak 50 gebruikers aan als deze er nog niet zijn
        if (User::count() === 0) {
            $users = User::factory()->count(50)->create();
        } else {
            $users = User::all();
        }

        // Maak 100 boeken, elk boek krijgt een willekeurige auteur
        foreach (range(1, 100) as $i) {
            // Kies een willekeurige auteur
            $author = $authors->random();

            // Maak een boek aan met deze auteur
            $book = Book::factory()->create([
                'author_id' => $author->id
            ]);

            // Voeg 0-4 reviews toe met willekeurige gebruikers
            $reviewCount = rand(0, 4);
            for ($j = 0; $j < $reviewCount; $j++) {
                // Kies een willekeurige gebruiker
                $user = $users->random();

                // Maak een review aan voor dit boek door deze gebruiker
                $review = Review::factory()->create([
                    'book_id' => $book->id,
                    'user_id' => $user->id
                ]);
            }
        }

        $this->call([
            GenreSeeder::class,
        ]);
    }
}
