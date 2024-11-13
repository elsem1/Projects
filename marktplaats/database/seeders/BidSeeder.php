<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;
use App\Models\Bid;
use App\Models\User;

class BidSeeder extends Seeder
{
    public function run()
    {
        $ads = Ad::all();

        foreach ($ads as $ad) {
            $rand = rand(1, 100);
            if ($rand <= 70) {
                $count = rand(1, 5);
            } elseif ($rand <= 90) {
                $count = rand(5, 10);
            } else {
                $count = rand(10, 30);
            }

            $previousBid = $ad->ask;
            for ($i = 0; $i < $count; $i++) {
                $newBidAmount = Bid::factory()->randomBid($previousBid);

                Bid::factory()->create([
                    'ad_id' => $ad->id,
                    'bid' => $newBidAmount,
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);

                $previousBid = $newBidAmount;
            }
        }
    }
}
