<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CallSlip;
use App\Models\Referral;
use App\Notifications\CallslipNotification;
use App\Notifications\CallSlipReschedule;
use App\Notifications\CallSlipCancelled;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;



class CallslipController extends Controller
{
        public function callslips(Request $request)
    {
        $filter_date = $request->input('filter_date');
        $filter_status = $request->input('filter_status');
        $counselor_id = Auth::user()->id;

        $query = CallSlip::query()->where('counselor_id', $counselor_id);
        if ($filter_date) {
            $query->whereDate('date', $filter_date);
        }
        if ($filter_status) {
            $query->where('status', $filter_status);
        }

        $callslips = $query->latest()->paginate();
        $students = User::where('user_type', 'student')->orderBy('name')->get();
        $instructors = User::where('user_type', 'instructor')->orderBy('name')->get();

        return view('counselor.callslips', compact('callslips', 'students', 'instructors', 'filter_date', 'filter_status'));
    }

    

    public function addCallslip(Request $request)
    {
        $request->validate(
            [
                'date' => 'required',
                'time' => 'required',           
            ],
            [
                'date.required' => 'Date is required',
                'time.required' => 'Time is required',
            ]
        );
        

      
        $callslip = CallSlip::create([
            'student_id' =>$request->student_id,
            'instructor_id' =>$request->instructor_id,
            'counselor_id' => auth()->user()->id,
            'date'=>$request->date,
            'time'=>$request->time
        ]);

        $startTime = Carbon::parse($request->input('date').' '.$request->input('time'), $request->timezone);
        $endTime = (clone $startTime)->addHour();
        
        $student = User::find($request->student_id);
        
        $attendees = [
            [
                'email' => $student->email,
                'name' => $student->name
            ]
        ];
        
        $event = Event::create([
            'name' => "Counseling session with $student->name",
            'startDateTime' => $startTime,
            'endDateTime' => $endTime
        ]);
        
        foreach ($attendees as $attendee) {
            $event->addAttendee([
                'email' => $attendee['email'],
                'name' => $attendee['name']
            ]);
        }
        
        
        $student = User::find($request->input('student_id'));
        $student->notify(new CallslipNotification($callslip->id));

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function updateCallslip(Request $request)
    {
        $request->validate([
            'up_date' => 'required',
            'up_time' => 'required',
        ], [
            'up_date.required' => 'Date is required',
            'up_time.required' => 'Time is required',
        ]);
    
        $callslip = CallSlip::find($request->up_id);
        if ($callslip) {
            if ($callslip->status === 'cancelled') {
                $callslip->status = 'pending for counseling';
            }
            $callslip->student_id = $request->up_student_id;
            $callslip->instructor_id = $request->up_instructor_id;
            $callslip->date = $request->up_date;
            $callslip->time = $request->up_time;
            $callslip->save();
    
            $startTime = Carbon::parse($request->input('up_date') . ' ' . $request->input('up_time'), $request->timezone);
            $endTime = (clone $startTime)->addHour();
    
            
            $oldEvent = $callslip->event;
            if ($oldEvent) {
                $oldEvent->delete();
            }
    
            $student = User::find($request->up_student_id);
    
            $attendees = [
                [
                    'email' => $student->email,
                    'name' => $student->name
                ]
            ];
    
            $event = Event::create([
                'name' => "Counseling session with $student->name",
                'startDateTime' => $startTime,
                'endDateTime' => $endTime
            ]);
    
            foreach ($attendees as $attendee) {
                $event->addAttendee([
                    'email' => $attendee['email'],
                    'name' => $attendee['name']
                ]);
            }
    
            // Send notification to student
            $user = User::find($request->up_student_id);
            if ($user) {
                $user->notify(new CallSlipReschedule($callslip));
            }
    
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Callslip not found',
            ], 404);
        }
    }
    

    public function viewCallSlip(Request $request, $id)
    {
        $callslip = Callslip::find($id);
        return view('counselor.view_callslip', compact('callslip'));
    }
    

    public function deleteCallslip(Request $request)
    {
        CallSlip::find($request->callslip_id)->delete();
        return response()->json(['status' => 'success']);
    }

    public function completeCallSlip($id)
    {
        $callSlip = CallSlip::find($id);
        $callSlip->status = 'completed';
        $callSlip->save();
        return response()->json(['status' => 'success']);
    }



    
    public function cancelCallSlip($id)
    {
        $callSlip = CallSlip::find($id);
        $callSlip->status = 'cancelled';
        $callSlip->save();
    
        User::find($callSlip->student_id)->notify(new CallSlipCancelled($callSlip->callslip_id));
        return response()->json(['status' => 'success']);
    }
    
    

    public function store(Request $request)
    {
        $referral = Referral::find($request->referral_id);
        if ($referral) {
            $callslip = new CallSlip();
            $callslip->student_id = $referral->student_id;
            $callslip->instructor_id = $referral->instructor_id;
            $callslip->date = $request->date;
            $callslip->time = $request->time;
            $callslip->save();

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
    }

   

}
