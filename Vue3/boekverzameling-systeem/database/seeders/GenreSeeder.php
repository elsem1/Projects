<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science Fiction'],
            ['name' => 'Mystery'],
            ['name' => 'Thriller'],
            ['name' => 'Romance'],
            ['name' => 'Fantasy'],
            ['name' => 'Horror'],
            ['name' => 'Biography'],
            ['name' => 'History'],
        ];

        DB::table('genres')->insert($genres);
    }
}
