<?php

namespace Database\Seeders;
use App\Models\Ad;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();

        Ad::factory()
            ->count(50)
            ->withCategories() 
            ->create();
    }
}
