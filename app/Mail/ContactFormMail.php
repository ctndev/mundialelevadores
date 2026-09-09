<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactFormMail extends Mailable
{
    public function __construct(public Contact $contact) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novo contato pelo site',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
        );
    }
}
