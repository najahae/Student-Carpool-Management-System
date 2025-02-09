<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RideCancellationNotification extends Notification
{
    use Queueable;

    public $rideDetails;

    public function __construct($rideDetails)
    {
        $this->rideDetails = $rideDetails;
    }

    public function via($notifiable)
    {
        return ['mail']; // Sending via email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Ride Cancellation Notification')
            ->line('We regret to inform you that your ride has been cancelled.')
            ->line('Ride Details:')
            ->line('Date: ' . $this->rideDetails['date'])
            ->line('Reason: ' . $this->rideDetails['reason'])
            ->line('If you have any questions, please contact us.')
            ->action('View Details', url('/ride-details'));
    }

    public function toArray($notifiable)
    {
        return [
            'ride_details' => $this->rideDetails,
        ];
    }
}
