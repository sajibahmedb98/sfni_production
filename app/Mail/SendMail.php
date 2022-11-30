<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use stdClass;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The order instance.
     *
     * @var stdClass
     */
    public $obj;

    /**
     * Create a new message instance.
     *
     * @param  stdClass  $obj
     * @return void
     */
    public function __construct(stdClass $obj)
    {
        $this->obj = $obj;
        // $this->email = $email;
        // $this->subject = $subject;
        // $this->message = $message;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'SFNI Website - Client Message',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail',
            // with: [
            //     'name' => $this->name,
            //     'email' => $this->email,
            //     'subject' => $this->subject,
            //     'message' => $this->message,
            // ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
