<?php

namespace App\Listeners;

use App\Events\SuccessfulRegistration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendSuccessfulRegistration
{
    public function handle(SuccessfulRegistration $event): void
    {
        Log::info('Handling SuccessfulRegistration event for user: ' . $event->user->email);
        Mail::to($event->user->email)->send(new \App\Mail\SuccessfulRegistration($event->user));
    }
}
