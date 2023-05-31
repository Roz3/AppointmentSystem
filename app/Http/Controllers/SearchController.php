<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reason;
use App\Models\Course;
use App\Models\Department;
use App\Models\Referral;
use App\Models\CallSlip;

class SearchController extends Controller
{
    public function adminSearch(Request $request)
    {
        $query = $request->input('query');
        
        $results1 = User::where('name', 'LIKE', "%$query%")->get();
        $results2 = Reason::where('reason', 'LIKE', "%$query%")->get();
        $results3 = Course::where('course', 'LIKE', "%$query%")->get();
        $results4 = Department::where('department', 'LIKE', "%$query%")->get();
        
        return view('/admin/adminSearch', compact('results1', 'results2', 'results3', 'results4', 'query'));
    }

    public function counselorSearch(Request $request)
    {
        $query = $request->input('query');
        
        $results1 = CallSlip::where('student_id', 'LIKE', "%$query%")->get();
       
        
        return view('/counselor/counselorSearch', compact('results1', 'query'));
        
    }

    public function instructorSearch(Request $request)
    {
        $query = $request->input('query');
        
        $results1 = Referral::where('student_id', 'LIKE', "%$query%")->get();
        $results2 = User::where('name', 'LIKE', "%$query%")->get();
       
        
        return view('/instructor/instructorSearch', compact('results1','results2', 'query'));
        
    }

    public function studentSearch(Request $request)
    {
        $query = $request->input('query');
        
        $results1 = Callslip::where('student_id', 'LIKE', "%$query%")->get();
       
        
        return view('/student/studentSearch', compact('results1', 'query'));
        
    }
}
