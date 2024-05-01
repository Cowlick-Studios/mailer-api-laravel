<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\EmailSubmission;

class Submission extends Mailable
{
    use Queueable, SerializesModels;

    private $emailSubmission;
    private $formData;

    /**
     * Create a new message instance.
     */
    public function __construct(EmailSubmission $emailSubmission, $formData)
    {
        $this->emailSubmission = $emailSubmission;
        $this->formData = $formData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New email submission: {$this->emailSubmission->name}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.submission',
            with: [
                'emailSubmission' => $this->emailSubmission,
                'formData' => $this->formData
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
