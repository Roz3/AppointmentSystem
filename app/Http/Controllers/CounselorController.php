<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

use App\Models\User;
use App\Models\Referral;
use App\Models\Reason;
use App\Models\Availability;
use App\Models\CallSlip;
use App\Models\Note;

use App\Notifications\NewReferral;
use App\Notifications\ReferralApproved;
use Illuminate\Support\Facades\Notification;

use Pusher\Pusher;



class CounselorController extends Controller
{
  
            //counselor profile
            public function counselorProfile()
            {
                $counselor = Auth::user();
                    return view('counselor.profile', compact('counselor'));
            }

            //counselor edit profile
            public function editProfile($id)
            {
                $counselor = Auth::user()->findOrFail($id);
                return view('counselor.editProfile', compact('counselor'));
            }
        
            public function updateProfile(Request $request, $id)
            {
                $counselor = User::findOrFail($id);
            
                $counselor->password = Hash::make($request->password);
                $counselor->barangay = $request->barangay ?? $counselor->barangay;
                $counselor->municipal = $request->municipal ?? $counselor->municipal;
                $counselor->province = $request->province ?? $counselor->province;
                $counselor->contact = $request->contact ?? $counselor->contact;
            
                $counselor->save();
            
                return redirect()->route('counselor.profile')->with('success', 'Profile updated successfully.');
            }
            

            //referrals

            public function referrals()
            {
                $user = auth()->user();
                $unreadNotifications = $user->unreadNotifications;
                $students = User::where('user_type', 'student')->orderBy('name')->get();
                $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();
                if ($user->user_type == 'counselor') {
                    $referrals = Referral::where('counselor_id', $user->id)->latest()->paginate(5);
            
                    foreach ($referrals as $referral) {
                        $notification = $referral->notifications->first();
                        if ($notification) {
                            $notification->markAsRead();
                        }
                    }
            
                    return view('/counselor/referrals', compact('referrals','students','instructors'));
                } else {
                    abort(403);
                }
            }
            //studentlist
            public function students()
            {
                $users = User::all();
                $userTypeCounts = [
                    User::where('user_type', 'student')->count(),
                    User::where('user_type', 'instructor')->count(),
                    User::where('user_type', 'counselor')->count(),
                ];
                $students = User::where('user_type', 'student')->orderBy('name')->paginate(20);
                return view('counselor.studentslist', compact ('students','userTypeCounts','users'));
            }
    
            //instructor list
            public function instructors()
            {
                $users = User::all();
                $userTypeCounts = [
                    User::where('user_type', 'student')->count(),
                    User::where('user_type', 'instructor')->count(),
                    User::where('user_type', 'counselor')->count(),
                ];
                $instructors = User::where('user_type', 'instructor')->orderBy('name')->paginate(20);
                return view('counselor.instructorslist', compact ('instructors','userTypeCounts','users'));
            }
    
     //view referral
    //public function viewReferral($referral_id)
            //{
               // $students = User::where('user_type', 'student')->get();
               // $instructors = User::where('user_type', 'instructor')->get();
               // $referral = Referral::findOrFail($referral_id);
                
            
                // Check if the authenticated user is the assigned counselor for the referral
               // if (Auth::user()->user_type == 'counselor' && Auth::user()->id == $referral->counselor_id) {
                   // if ($referral) {
                      //  $referral->markAsRead(); // Mark referral notification as read
                       // return view('/counselor/view_referral', compact('referral','students','instructors'));
                   // } else {
                      //  abort(404); // Return a not found HTTP response if referral does not exist
                  //  }
               // } else {
                   // abort(403); // Return a forbidden HTTP response if user is not the assigned counselor
               // }
           // }
            
           //delete referral
            public function destroy($id)
            {
                $referral = Referral::find($id);

                if (!$referral) {
                    return redirect()->back()->with('error', 'Referral not found');
                }

                $referral->delete();

                return redirect()->back()->with('success', 'Referral deleted successfully');
            }

            //approved referral
           public function approvedReferral(Request $request, $id)
            {
                $referral = Referral::find($id);
                $referral->status = 'done';
                $referral->save();

                $instructor = User::find($referral->instructor_id);
                $instructor->notify(new ReferralApproved($referral->referral_id));

                return response()->json(['status' => 'success']);
            }

            // show notif
            public function showNotification()
            {
                $notifications = auth()->user()->notifications;
                auth()->user()->unreadNotifications->markAsRead();
                return view('counselor.notifications', compact('notifications'));
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
            
            //view records
            public function records(Request $request)
            {
                $type = $request->get('type', 'callslips');
                $students = User::where('user_type', 'student')->orderBy('name')->get();
                $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();

                if ($type == 'callslips') {
                    $callslips = CallSlip::where('status', 'completed')->get();
                    return view('counselor.records', compact('callslips', 'type'));
                } elseif ($type == 'referrals') {
                    $referrals = Referral::where('status', 'done')->get();
                    return view('counselor.records', compact('referrals', 'type','students','instructors'));
                }
            }

            //view callslip modal
            public function viewCallslip(Request $request)
            {
                $callslip = CallSlip::find($request->id);
                $students = User::where('user_type', 'student')->orderBy('name')->get();
                $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();
                return response()->json($callslip);
            }
            
            //view referral modal
            public function viewReferral($id)
            {
                $students = User::where('user_type', 'student')->orderBy('name')->get();
                $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();
                $referral = Referral::findOrFail($id);
                return view('counselor.view-referral', compact('referral','students','instructors'));
            }

            public function getReferral($id)
            {
                $students = User::where('user_type', 'student')->orderBy('name')->get();
                $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();
                $referral = Referral::findOrFail($id);
                return view('counselor.view_referral', compact('referral','students','instructors'));
            }
        
            public function showAvailabilityForm()
            {
                return view('counselor.add_availability');
            }

            public function addAvailability(Request $request)
            {
                $validatedData = $request->validate([
                    'date' => 'required|date',
                    'start_time' => 'required|date_format:H:i',
                    'end_time' => 'required|date_format:H:i|after:start_time',
                ]);

                $counselor = Auth::user();

                $availability = new Availability;
                $availability->counselor_id = $counselor->id;
                $availability->date = $validatedData['date'];
                $availability->start_time = $validatedData['start_time'];
                $availability->end_time = $validatedData['end_time'];
                $availability->save();

                return response()->json([
                    'status' => 'success',
                ]);
            }


            public function availability() {
                $counselor = Auth::user();
                $availabilities = $counselor->availabilities()->orderBy('date', 'asc')->get();
                return view('counselor.availability', compact('availabilities'));
            }

            public function deleteAvailability(Request $request)
            {
                Availability::find($request->availability_id)->delete();
                return response()->json(['status' => 'success']);
            }

            public function deleteReferral(Request $request)
            {
               Referral::find($request->referral_id)->delete();
                return response()->json(['status' => 'success']);
            }
            
            public function addNote(Request $request)
            {
                $validatedData = $request->validate([
                    'content' => 'required'
                ],
            
            [
                'content.required' => 'Note field is required.'

            ]);
            
                $note =Note::create([
                $note->callslip_id => $request->callslip_id,
                $note->content => $request->content
                ]);
            
                return response()->json([
                    'status' => 'success',
                ]);
            }
            
            //view callslip in records
            public function getCallslip($id)
            {
                $students = User::where('user_type', 'student')->orderBy('name')->get();
                $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();
                $callslip = CallSlip::findOrFail($id);
                return view('counselor.view-callslip', compact('callslip','students','instructors'));
            }
            
}
