<?php

namespace App\Mail;

use App\Models\ShuttleReservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShuttleReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public ShuttleReservation $reservation;

    /**
     * Create a new message instance.
     */
    public function __construct(ShuttleReservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre réservation de navette',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.shuttle.confirmation',
            with: [
                'reservation' => $this->reservation, // on transmet la variable à la vue
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
