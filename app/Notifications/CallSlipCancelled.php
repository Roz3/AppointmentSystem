<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class CallSlipCancelled extends Notification
{
    use Queueable;

    protected $callslipId;

    public function __construct($callslipId)
    {
        $this->callslipId = $callslipId;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }


    public function toArray($notifiable)
    {
        return [
            'data' => 'Your appointment has been cancelled',
        ];
    }

    public function toMail($notifiable)
    {
        $studentName = $notifiable->name;
        $counselorName = auth()->user()->name;

        return (new MailMessage)
                ->subject('Appointment Cancelled')
                ->line($studentName . ', your appointment with ' . $counselorName . ' has been cancelled.')
                ->action('View Callslip', route('student.callslips'))
                ->line('Thank you for using our application!');
    }
}
