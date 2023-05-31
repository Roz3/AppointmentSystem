<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CallSlip;
use App\Models\Course;
use App\Models\Referral;
use App\Models\Department;
use App\Models\Reason;


class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $userTypeLabels = ['Student', 'Instructor','Counselor','Admin'];
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
            User::where('user_type', 'instructor')->count(),
            User::where('user_type', 'counselor')->count(),
            User::where('user_type', 'admin')->count(),
        ];

        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $coursesCount = Course::count();
        $collegesCount = Department::count();
        $reasonsCount = Reason::count();
        $counselor = Auth::user(); 
        $notifications = $counselor->notifications; 
    
        return view('/admin/dashboard', compact('userTypeLabels', 'userTypeCounts','recentUsers', 'notifications', 'coursesCount', 'collegesCount','reasonsCount' ));
    }

    public function counselorDashboard()
    {
        $callslips = CallSlip::where('counselor_id', Auth::user()->id)->get();
        $counselor = Auth::user()->counselor;
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
            User::where('user_type', 'instructor')->count(),
        ];
        $pendingCount = $callslips->where('status', 'pending for counseling')->count();
        $completedCount = $callslips->where('status', 'completed')->count();
        $referralsReceived = Referral::where('counselor_id', Auth::user()->id)
                                  ->orderBy('created_at', 'desc')
                                  ->get();
        $referralsApproved = Referral::where('status','done')->count();
        $pendingReferrals = Referral::where('status','pending')->count();
       // $cancelledCount = $callslips->where('status', 'cancelled')->count();
    
        if ($counselor) {
            $upcomingAppointments = $counselor->callslips()->where('date', '>', now())->orderBy('date')->get();
        } else {
            $upcomingAppointments = collect();
        }
    
        return view('counselor.dashboard', compact('callslips', 'completedCount', 'pendingCount', 'referralsReceived', 'upcomingAppointments', 'userTypeCounts', 'referralsApproved', 'pendingReferrals'));
    }
    

    public function instructorDashboard()
    {
        $referrals = Referral::where('instructor_id', Auth::user()->id)->get();
        $instructor = Auth::user()->instructor;
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
        ];
        $pendingReferral = $referrals->where('status', 'pending')->count();
        $doneReferralCount = $referrals->where('status', 'done')->count();
    
        return view('instructor.dashboard', compact('pendingReferral', 'doneReferralCount','referrals','userTypeCounts'));
    }

}
