<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnAttente extends Mailable
{
    use Queueable, SerializesModels;

    protected $demandes;
    protected $nom_admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom_admin,$demandes)
    {
        $this->nom_admin=$nom_admin;
        $this->demandes=$demandes;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Demandes en attente de prise en charge',
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
            markdown: 'emails.enattente',
            with:[
                'nom_admin'=>$this->nom_admin,
                'demandes'=>$this->demandes
            ]
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
