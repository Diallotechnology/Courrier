<?php

namespace App\Notifications;

use App\Models\Courrier;
use App\Models\Interne;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourrierNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Model $courrier, public string $message)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast', 'database', 'mail'];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message,
        ]);
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
                ->action('Voir le courrier', route('arriver.show', $this->courrier))
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
