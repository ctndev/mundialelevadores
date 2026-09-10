<?php

namespace App\Jobs;

use App\Mail\AccessCredentialsMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendAccessCredentialsMailJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public User $user,
        public string $temporaryPassword,
        public bool $isReset = false,
    ) {}

    public function handle(): void
    {
        Mail::to($this->user->email)->send(new AccessCredentialsMail(
            $this->user,
            $this->temporaryPassword,
            $this->isReset,
        ));
    }
}
