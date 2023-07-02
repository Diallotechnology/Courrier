<?php

namespace App\Notifications;

use App\Models\Courrier;
use App\Models\Interne;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourrierNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Model $courrier, private string $message)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if ($this->courrier instanceof Interne) {
            return (new MailMessage)
                ->line($this->message)
                ->action('Voir le courrier', route('interne.show', $this->courrier))
                ->line('Merci!');
        }
        if ($this->courrier instanceof Courrier) {
            return (new MailMessage)
                ->line($this->message)
                ->action('Voir le courrier', route('courrier.show', $this->courrier))
                ->line('Merci!');
        }

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $ref = $this->courrier->numero;

        return [
            'message' => $this->message,
            'type' => "courrier  N°$ref",
        ];
    }
}
