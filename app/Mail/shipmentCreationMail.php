<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class shipmentCreationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $shipment;
    public function __construct($request,$shipment)
    {
        $this->request = $request;
        $this->shipment = $shipment;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipment Creation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'shipments.mails.shipment_creation_mail',
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
