<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bid>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bid' => $this->randomBid(),
            'user_id' => User::factory(),
            'ad_id' => Ad::factory(),
        ];
    }

    public function randomBid()
    {
        $min = $this->Ad::
    }
}
