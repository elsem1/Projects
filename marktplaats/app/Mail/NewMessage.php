<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Models\Message;


class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $user)
    {
        $this->messageContent = $message;
        $this->user = $user;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newMessage',
            with: [
                'message' => $this->messageContent,
                'user' => $this->user
            ],
        );
    }
}
