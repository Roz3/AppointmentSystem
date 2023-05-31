<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\CallSlip;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CallSlipReschedule extends Notification
{
    use Queueable;

    protected $callslip;

    public function __construct(CallSlip $callslip)
    {
        $this->callslip = $callslip;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }

    public function toArray($notifiable)
    {
        return [
            'data' => "Your call slip with ID #{$this->callslip->id} has been updated. Please check your appointments for the latest details.",
        ];
    }

    public function toMail($notifiable)
    {
        $studentName = $notifiable->name;
        $counselorName = auth()->user()->name;
    
        return (new MailMessage)
            ->subject('Appointment Rescheduled')
            ->line($studentName . ', your appointment with ' . $counselorName . ' has been rescheduled. Please view your appointment to see more details.')
            ->action('View Appointment', route('student.callslips'))
            ->line('Thank you for using our application!');
    }
    
}