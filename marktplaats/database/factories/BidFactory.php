<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ad;
use App\Models\Bid;

class BidFactory extends Factory
{
    protected $model = Bid::class;

    public function definition(): array
    {
        return [
            'bid' => $this->faker->randomFloat(2, 1, 100),
            'user_id' => User::factory(),
            'ad_id' => Ad::factory(),
        ];
    }

    public function randomBid(float $previousBid)
    {
        $increment = rand(1, 10) / 100;
        $newBid = $previousBid * (1 + $increment);
        return round($newBid, 2);
    }
}

