<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reason;


class ReasonController extends Controller
{
    public function reasons()
    {
        $reasons = Reason::orderBy('reason')->paginate(5);
        $reasonsCount = Reason::count();
        return view('/admin/reasons',compact('reasons','reasonsCount'));
    }

    public function addReason(Request $request)
    {
        $request->validate([
            'reason' => 'required|unique:reasons',
        ], [
            'reason.required' => 'Reason is required.',
            'reason.unique' => 'Reason already exists.',
        ]);
    
        $reason = new Reason();
        $reason->reason = $request->reason;
        $reason->description = $request->description;
        $reason->save();
    
        return response()->json([
            'status' => 'success',
        ]);
    }
    

    //update

    public function updateReason(Request $request){
        $request->validate(
            [
                'up_reason' => 'required|unique:reasons,reason,'.$request->up_id,
                'up_description' => 'required|unique:reasons,description,'.$request->up_id,
            ],
            [
                'up_reason.required' => 'Reason is required.',
                'up_reason.unique' => 'Reason already exists.',
            ]
        );

        $reason = Reason::find($request->up_id);
                if ($reason) {
                    $reason->reason = $request->up_reason;
                    $reason->description = $request->up_description;
                    $reason->save();
                    return response()->json([
                     'status' => 'success',
                 ]);
        } else {
                 return response()->json([
                     'status' => 'error',
                    'message' => 'Reason not found.',
                ], 404);
        }

    
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteReason(Request $request){
       Reason::find($request->reason_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

      //view reason
      public function viewReason(Request $request)
      {
          $reason = Reason::find($request->id);
          return response()->json($reason);
      }
}
