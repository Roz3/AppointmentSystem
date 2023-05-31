<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Notification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReferralNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = Auth::user()->notifications;
        return response()->json(['notifications' => $notifications]);
    }
}