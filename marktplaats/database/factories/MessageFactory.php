<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    protected $model = Message::class;
    
    public function definition()
    {
    $sender = User::inRandomOrder()->first(); 
    $receiver = User::inRandomOrder()->where('id', '!=', $sender->id)->first(); 

    return [ 
        'sender_id' => $sender->id, 
        'receiver_id' => $receiver->id, 
        'message' => $this->faker->sentence, 
    ];            
    }
}
