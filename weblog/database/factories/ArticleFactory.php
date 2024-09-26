<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;



class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
    return [
            'title'=> $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'premium' => $this->faker->boolean(12.5), 
            'user_id' => User::factory(),
        ];   
    }
    public function withCategories()
    {
        return $this->afterCreating(function (Category $article) {    
                $count = (rand(1,100) <= 70 ) ? 1 : ((rand(1, 100) <= 90) ? 2 : 3);
                $categories = Category::inRandomOrder()->limit($count)->pluck('id');
                $article->categories()->attach($categories);
        });
    }
}  

