<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReferralNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $referral_id;

    public function __construct($referral_id)
    {
        $this->referral_id = $referral_id;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = route('counselor.view_referral', $this->referral_id);
        $instructorName = auth()->user()->name;
    
        return (new MailMessage)
            ->subject('New Referral Notification')
            ->line($instructorName . ' referred a student for counseling. Please view referral to see more details.')
            ->action('View Referral', $url)
            ->line('Thank you for using our application!');
    }
    
    public function toArray($notifiable)
    {
        return [
            'data' => 'You have a new referral',
        ];
    }
}
