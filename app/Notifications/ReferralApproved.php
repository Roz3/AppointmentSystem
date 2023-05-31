<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReferralApproved extends Notification
{
    use Queueable;

    protected $referralId;

    public function __construct($referralId)
    {
        $this->referralId = $referralId;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }


    public function toArray($notifiable)
    {
        return [
            'data' => 'Your referral has been approved',
            'referral_id' => $this->referralId,
        ];
    }

    public function toMail($notifiable)
    {
        $counselorName = auth()->user()->name;
        return (new MailMessage)
            ->subject('Referral Approved')
            ->line('Your referral has been approved by '. $counselorName)
            ->line('Thank you for using our application!');
    }
}
