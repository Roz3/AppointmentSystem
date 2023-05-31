<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReferralNotification;
use App\Notifications\ReferredNotification;

use App\Models\User;
use App\Models\CallSlip;
use App\Models\Referral;
use App\Models\Availability;
use App\Models\Reason;
use App\Models\Department;
use App\Models\Course;


class StudentController extends Controller
{
    public function appointmentHistory()
    {
        // Get the current student's ID
        $studentId = Auth::id();
    
        // Get the callslips for the current student with completed status
        $callslips = Callslip::where('student_id', $studentId)
                              ->where('status', 'completed')
                              ->orderBy('date', 'desc')
                              ->orderBy('time', 'desc')
                              ->get();
    
        return view('student.home', compact('callslips'));
    }
    

    public function callSlips()
    {
        $user = auth()->user();
        $students = User::where('user_type', 'student')->get();
        $instructors = User::where('user_type', 'instructor')->get();
        $callslips = CallSlip::where('student_id', $user->id)->get();
        

        return view('student.callslips', compact('callslips'));
    }

    public function showCallSlip($id)
    {
        $callslip = CallSlip::findOrFail($id);
        
        if (auth()->user()->id !== $callslip->student_id) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('student.view_callslips', compact('callslip'));
    }


    public function studentProfile()
    {
        $student = Auth::user();
        $courses = Course::all();
        $departments = Department::all();
            return view('student.profile', compact('student','courses','departments'));
    }

    public function editProfile($id)
    {
        $student = Auth::user()->findOrFail($id);
        $courses = Course::all();
        $departments = Department::all();
        return view('student.editProfile', compact('student','courses','departments'));
    }

    public function updateProfile(Request $request, $id)
    {
        $student = User::findOrFail($id);
    
        $student->password = Hash::make($request->password);
        $student->department_id = $request->department_id ?? $student->department_id;
        $student->course_id = $request->course_id ?? $student->course_id;
        $student->year_level = $request->year_level ?? $student->year_level;
        $student->barangay = $request->barangay ?? $student->barangay;
        $student->municipal = $request->municipal ?? $student->municipal;
        $student->province = $request->province ?? $student->province;
        $student->contact = $request->contact ?? $student->contact;
    
        $student->save();
    
        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }
    
    


    public function showNotification()
    {
        $notifications = auth()->user()->notifications;
        auth()->user()->unreadNotifications->markAsRead();
        return view('student.notifications', compact('notifications'));
    }

    public function markAsRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }

      
     //delete all notif
     public function deleteAll()
     {
         auth()->user()->notifications()->delete();

         return redirect()->back()->with('success', 'All notifications have been deleted.');
     }
       
       //delete notif
    public function deleteNotification($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

      //view callslip
      public function viewCallslip(Request $request)
      {
          $callslip = CallSlip::find($request->id);
          return response()->json($callslip);
      }

      public function referrals()
      {
          $user = auth()->user();
          $unreadReferral = $user->unreadReferrals()->first();
          if ($unreadReferral) {
              $unreadReferral->markAsRead();
          }
      
          if ($user->user_type == 'student') {
              $referrals = Referral::where('student_id', $user->id)
                                   ->latest()
                                   ->paginate(5);
          } elseif ($user->user_type == 'instructor') {
              $referrals = Referral::where('instructor_id', $user->id)
                                   ->latest()
                                   ->paginate(5);
          } else {
              abort(403);
          }
      
          $students = User::where('user_type', 'student')->get();
          $counselors = User::where('user_type', 'counselor')->get();
          $reasons = Reason::all();
      
          if ($counselors->count() > 0) {
              $counselor = $counselors->first();
              $availabilities = $counselor->availabilities()->orderBy('date', 'asc')->get();
          } else {
              $availabilities = [];
          }
      
          return view('/student/referrals', compact('referrals', 'students', 'counselors', 'reasons', 'availabilities'));
      }
      
      public function addReferral(Request $request)
      {
          $user = auth()->user();
      
          if ($user->user_type === 'student') {
              $referral = Referral::create([
                  'student_id' => $user->id,
                  'referral_details' => $request->input('referral_details'),
                  'referral_previous_interventions' => $request->input('referral_previous_interventions'),
                  'reason_id' => $request->input('reason_id'),
                  'instructor_id' => null,
                  'first_choice' => $request->input('first_choice'),
                  'second_choice' => $request->input('second_choice'),
                  'counselor_id' => $request->input('counselor_id')
              ]);
      
              $counselor = User::find($request->input('counselor_id'));
              $counselor->notify(new ReferralNotification($referral->id));
      
              $user->notify(new ReferredNotification($referral->id));
      
              return response()->json([
                  'status' => 'success',
              ]);
          } elseif ($user->user_type === 'instructor') {
              $referral = Referral::create([
                  'student_id' => $request->input('student_id'),
                  'referral_details' => $request->input('referral_details'),
                  'referral_previous_interventions' => $request->input('referral_previous_interventions'),
                  'reason_id' => $request->input('reason_id'),
                  'instructor_id' => $user->id,
                  'first_choice' => $request->input('first_choice'),
                  'second_choice' => $request->input('second_choice'),
                  'counselor_id' => $request->input('counselor_id')
              ]);
      
              $counselor = User::find($request->input('counselor_id'));
              $counselor->notify(new ReferralNotification($referral->id));
      
              $student = User::find($request->input('student_id'));
              $student->notify(new ReferredNotification($referral->id));
      
              return response()->json([
                  'status' => 'success',
              ]);
          } else {
              abort(403);
          }
      }
      
    
    public function getReferral($id)
    {
        $referral = Referral::findOrFail($id);
        return view('student.view_referral', compact('referral'));
    }

}
