<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerGroupsMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $subject;
    public $body;
    public $customerEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $customerEmail)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->customerEmail = $customerEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            to: $this->customerEmail
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.mailTemplate',
            with: [
                'content' => $this->body,
                'customer' => Customer::whereEmail($this->customerEmail)->first()
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
