<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class MessageHello extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $data;
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Message Hello',
            // from:new Address(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME")),

        );
    }


    /**
     * Get the message content definition.
     */
    public function content()
    // Content
    {

    //     $cssToInlineStyles = new CssToInlineStyles();

    // $html = view('hello')->render();
    // $css = file_get_contents(public_path('css/email.css'));

    // $inlinedHtml = $cssToInlineStyles->convert($html, $css);

    // return $this->html($inlinedHtml);


        return new Content(
            
            view: 'emails.transactional',
            // "data":$date
            // htmlString: $inlinedHtml
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