<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NewMessage
{
    use Dispatchable, SerializesModels;

    public $message;
    public $user;

    public function __construct($message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }
}

