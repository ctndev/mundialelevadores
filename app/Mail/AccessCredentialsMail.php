<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class AccessCredentialsMail extends Mailable
{
    public function __construct(
        public User $user,
        public string $temporaryPassword,
        public bool $isReset = false,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->isReset
                ? 'Sua senha de acesso foi redefinida'
                : 'Seu acesso ao painel',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.access-credentials',
        );
    }
}
