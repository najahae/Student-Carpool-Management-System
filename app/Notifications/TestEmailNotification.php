<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TestEmailNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        // No dynamic data needed for testing
    }

    public function via($notifiable)
    {
        return ['mail']; // Email only
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Ride Cancellation Notification')
        ->line('We regret to inform you that your ride has been cancelled.')
        ->line('Ride Details:')
        ->line('Date: ')
        ->line('Reason: ')
        ->line('If you have any questions, please contact us.')
        ->action('View Details', url('/ride-details'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
