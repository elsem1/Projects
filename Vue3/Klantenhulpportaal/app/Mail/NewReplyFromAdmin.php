<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewReplyFromAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $reply;
    public $admin;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket, Reply $reply, User $admin)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
        $this->admin = $admin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nieuwe reactie op uw ticket: ' . $this->ticket->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.newReplyFromAdmin',
            with: [
                'ticket' => $this->ticket,
                'reply' => $this->reply,
                'admin' => $this->admin,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
