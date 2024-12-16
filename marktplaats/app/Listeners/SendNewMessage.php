<?php
namespace App\Listeners;

use App\Events\NewMessage;
use App\Mail\NewMessage as NewMessageMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewMessage implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(NewMessage $event): void
    {
     Log::info('Handling NewMessage event with message: ' . $event->message->message); 
     Mail::to($event->user->email)->send(new NewMessageMail($event->message, $event));
    }
}
