<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class BugReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * This will contain name, email, description, and images (if any)
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADDRESS'), // The sender email, fetched from .env
            subject: 'Bug Report From ' . $this->data['name'], // The subject including user's name
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bugreport', // Refers to the view file for email content
            with: [
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'description' => $this->data['description'],
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if (isset($this->data['images'])) {
            foreach ($this->data['images'] as $image) {
                $attachments[] = Attachment::fromPath($image->getRealPath())
                    ->as($image->getClientOriginalName())
                    ->withMime($image->getMimeType());
            }
        }

        return $attachments;
    }
}
