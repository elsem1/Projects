<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Message;

use function Laravel\Prompts\text;

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
        'subject' => implode(' ', $this->faker->words),
        'message' => $this->faker->paragraph(1,10),

    ];
    }
}
