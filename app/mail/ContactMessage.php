<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public string $fromName;
    public string $fromEmail;
    public string $body;

    /**
     * Create a new message instance.
     */
    public function __construct(string $fromName, string $fromEmail, string $body)
    {
        $this->fromName  = $fromName;
        $this->fromEmail = $fromEmail;
        $this->body      = $body;
    }

    public function build()
    {
        return $this->subject('New Contact Message — SimpleWear')
            ->replyTo($this->fromEmail, $this->fromName)
            ->view('emails.contact');
    }
}
