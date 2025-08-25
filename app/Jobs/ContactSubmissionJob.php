<?php

namespace App\Jobs;

use App\Mail\ContactFormMail;
use App\Mail\ContactFormThankYouMail;
use App\Models\Contact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ContactSubmissionJob implements ShouldQueue
{
    use Queueable;

    protected $contact;

    /**
     * Create a new job instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->contact->spam_score <= 0.6) {
            // Send thank you email to submitter
            Mail::to($this->contact->email)->send(new ContactFormThankYouMail($this->contact));
        }
        // Send notification email to admin
        Mail::to('insanestaffing@gmail.com')->send(new ContactFormMail($this->contact));
    }
}
