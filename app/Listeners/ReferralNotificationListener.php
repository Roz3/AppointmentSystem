<?php

namespace App\Listeners;

use App\Notifications\ReferralNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReferralNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ReferralNotification $notification)
    {
        $referral = $notification->referral;

        // Find the counselor user with the given ID
        $counselor = \App\User::where('user_type', 'counselor')
                              ->where('id', $referral->counselor_id)
                              ->first();

        if ($counselor) {
            // Send the notification to the counselor
            $counselor->notify($notification);
        }
    }
}
