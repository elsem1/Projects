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

    public function withBids()
    {
        return $this->afterCreating(function (Ad $ad)
        {
            $rand = rand(1, 100);
            if ($rand <= 70) {
                $count = rand(0, 5);
            } elseif ($rand <= 90) {
                $count = rand(5, 10);
            } else {
                $count = rand(10, 30);
            }
            $bids = Category::inRandomOrder()->limit($count)->pluck('id');
            $ad->bids()->attach($bids);
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
