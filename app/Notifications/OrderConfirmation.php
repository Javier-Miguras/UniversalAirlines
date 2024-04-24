<?php

namespace App\Notifications;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderConfirmation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $user_id;
    public $flight_id;

    public function __construct($user_id, $flight_id)
    {
        //
        $this->user_id = $user_id;
        $this->flight_id = $flight_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $user = User::find($this->user_id);
        $flight = Flight::find($this->flight_id);

        return (new MailMessage)
                    ->line(ucfirst($user->name) . ', you have successfully completed your purchase:')
                    ->line($flight->origin . ' / ' . $flight->destination)
                    ->line('Date: ' . $flight->date->format('d-m-Y'))
                    ->line('Visit the following link to view your tickets.')
                    ->action('My Tickets', url('/dashboard'))
                    ->line('Thank you for choosing Universal Airlines.');
    }
}
