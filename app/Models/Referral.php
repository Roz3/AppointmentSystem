<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'referral_details',
        'referral_previous_interventions',
        'date',
        'reason_id',
        'instructor_id',
        'first_choice',
        'second_choice',
        'counselor_id',
        'status'
        
    ];

    
    public function markAsRead()
    {
        $this->notifications()->where('type', ReferralNotification::class)->get()->each(function (DatabaseNotification $notification) {
            $notification->markAsRead();
        });
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function isDeletedByInstructor()
    {
        return $this->deleted_by_instructor;
    }


}

