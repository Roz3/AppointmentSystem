<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Reason;
use App\Models\Referral;
use App\Notifications\ReferralNotification;
use App\Notifications\ReferredNotification;
use App\Notifications\ReferralApproved;
use Illuminate\Support\Facades\Notification;


class InstructorController extends Controller
{
    
    public function instructorProfile()
    {
        $instructor = Auth::user();
            return view('instructor.profile', compact('instructor'));
    }

       //instructor edit profile
       public function editProfile($id)
       {
           $instructor = Auth::user()->findOrFail($id);
           return view('instructor.editProfile', compact('instructor'));
       }
   
       public function updateProfile(Request $request, $id)
       {
           $instructor = User::findOrFail($id);
       
           $instructor->password = Hash::make($request->password);
           $instructor->barangay = $request->barangay ?? $instructor->barangay;
           $instructor->municipal = $request->municipal ?? $instructor->municipal;
           $instructor->province = $request->province ?? $instructor->province;
           $instructor->contact = $request->contact ?? $instructor->contact;
       
           $instructor->save();
       
           return redirect()->route('instructor.profile')->with('success', 'Profile updated successfully.');
       }
       


    //referrals
    public function referrals()
    {
        $user = auth()->user();
        $unreadReferral = $user->unreadReferrals()->first();
        if ($unreadReferral) {
            $unreadReferral->markAsRead();
        }
    
        if ($user->user_type == 'instructor') {
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
    
        return view('/instructor/referrals', compact('referrals', 'students', 'counselors', 'reasons', 'availabilities'));
    }
    
    
    

    //add referral
    public function addReferral(Request $request)
    {
       
        $referral = Referral::create([
            'student_id' => $request->input('student_id'),
            'referral_details' => $request->input('referral_details'),
            'referral_previous_interventions' => $request->input('referral_previous_interventions'),
            'reason_id' => $request->input('reason_id'),
            'instructor_id' =>  auth()->user()->id,
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
    }



        // update referral
        public function updateReferral(Request $request){
            $request->validate(
                [
                    'up_student_id' => 'required',
                    'up_referral_details' => 'required',
                    'up_referral_previous_interventions' => 'required',
                    'up_reason_id' => 'required',
                   
                ],
                [
                    'up_student_id.required' => 'Student name is required',
                    'up_referral_details.required' => 'Details is required',
                    'up_referral_previous_interventions.required' => 'Referral interventions is required',
                    'up_reason_id.required' => 'Reason is required',
                   
                ]
            );

                        $referral = Referral::find($request->up_id);
                        if ($referral) {
                            $referral->student_id = $request->up_student_id;
                            $referral->referral_details = $request->up_referral_details;
                            $referral->referral_previous_interventions = $request->up_referral_previous_interventions;
                            $referral->reason_id = $request->up_reason_id;
                            $referral->instructor_id = Auth::user()->id;
                            $referral->save();
                            return response()->json([
                            'status' => 'success',
                        ]);
                } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Referral not found',
                        ], 404);
                }

                return response()->json([
                    'status' => 'success',
                ]);
            }


            //view referral
            //public function viewReferral(Request $request)
           // {
                //$referral = Referral::find($request->id);
                //return response()->json($referral);
            //}
            
            
            

            public function getReferral($id)
            {
                $referral = Referral::findOrFail($id);
                return view('instructor.view_referral', compact('referral'));
            }

            public function deleteReferral(Request $request)
            {
                $referral = Referral::find($request->input('referral_id'));

                $referral->deleted_by_instructor = true;
                $referral->save();
                
               
                $referral->instructor->referralsAsInstructor()->detach($referral->id);
            
               
                if ($referral->counselor_id) {
                    return response()->json(['status' => 'success']);
                }
            
               
                $referral->delete();
            
                return response()->json(['status' => 'success']);
            }            
            

            //show notif
            public function showNotification()
            {
                $notifications = auth()->user()->notifications;
                auth()->user()->unreadNotifications->markAsRead();
                return view('instructor.notifications', compact('notifications'));
            }

            //mark as read notif
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

            public function students()
            {
                $users = User::all();
                $userTypeCounts = [
                    User::where('user_type', 'student')->count(),
                    User::where('user_type', 'instructor')->count(),
                    User::where('user_type', 'counselor')->count(),
                ];
                $students = User::where('user_type', 'student')->orderBy('name')->paginate(20);
                return view('instructor.studentslist', compact ('students','userTypeCounts','users'));
            }
            
}

