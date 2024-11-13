<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ad;
use App\Models\User;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph(3,10),
            'user_id' => rand(1, User::count()),
            'ask' => $this->randomAskPrice(),


        ];
    }

    public function withCategories()
    {
        return $this->afterCreating(function (Ad $ad) 
        {    
                $count = (rand(1,100) <= 70 ) ? 1 : ((rand(1, 100) <= 90) ? 2 : 3);
                $categories = Category::inRandomOrder()->limit($count)->pluck('id');
                $ad->categories()->attach($categories);
        });
    }
    function randomAskPrice()
    {

        $min = 0.5;
        $max = 1500;
        $askPrice =  random_int($min , $max);
        return round($askPrice);
    }
}
