<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Définit l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Réservation confirmée par le client',
        );
    }

    /**
     * Définit le contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin.confirmation',
        );
    }

    /**
     * Fichiers joints éventuels.
     */
    public function attachments(): array
    {
        return [];
    }
}
