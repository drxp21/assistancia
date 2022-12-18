<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNouvelleDemande extends Mailable
{
    use Queueable, SerializesModels;

    protected $nom;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom,$objet,$contenu)
    {
        $this->nom = $nom;
        $this->objet = $objet;
        $this->contenu = $contenu;

    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Mail Nouvelle Demande',
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
            markdown: 'emails.MailNouvDemande',
            with:[
                'nom'=>$this->nom,
                'objet'=>$this->objet,
                'contenu'=>$this->contenu,
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
