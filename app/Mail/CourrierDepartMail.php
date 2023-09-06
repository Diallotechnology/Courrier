<?php

namespace App\Mail;

use App\Models\Depart;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CourrierDepartMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Depart $depart)
    {

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau Courrier Depart',
            from: new Address($this->depart->structure->email, $this->depart->structure->nom),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.courrier_depart',
        );
    }

    public function build()
    {
        $pdfFilePath = asset('img/bg_login.png');

        // Generate a temporary URL for the PDF file
        // $pdfUrl = Storage::disk('local')->url($pdfFilePath);

        return $this->markdown('email.courrier_depart')
            ->attach(
                $pdfFilePath,
                [
                    'as' => 'laravelia.pdf',
                    'mime' => 'application/pdf',
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
        // dd($this->depart->folder->documents->pluck('chemin'));
        return [];
    }
}
