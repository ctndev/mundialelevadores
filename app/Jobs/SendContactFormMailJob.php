<?php

namespace App\Jobs;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendContactFormMailJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Contact $contact) {}

    public function handle(): void
    {
        foreach (SiteSetting::contactNotificationEmails() as $email) {
            Mail::to($email)->send(new ContactFormMail($this->contact));
        }
    }
}
