<?php

namespace App\Events;

use App\Models\Referral;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReferralApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $referral;

    public function __construct(Referral $referral)
    {
        $this->referral = $referral;
    }

    public function broadcastOn()
    {
        return ['appointment-system'];
    }

    public function broadcastAs()
    {
        return 'referral.approved';
    }

}
