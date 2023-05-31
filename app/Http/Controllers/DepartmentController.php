<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function departments()
    {
        $departments =Department::latest()->paginate();
        $collegesCount = Department::count();
        return view('/admin/departments',compact('departments','collegesCount'));
    }

    public function addDepartment(Request $request)
    {
        $request->validate([
            'department' => 'required|unique:departments',
        ], [
            'department.required' => 'College is required.',
            'department.unique' => 'College already exists.',
        ]);
    
        $department = new Department();
        $department->department = $request->department;
        $department->abbreviation = $request->abbreviation;
        $department->save();
    
        return response()->json([
            'status' => 'success',
        ]);
    }
    
    //update

    public function updateDepartment(Request $request){
        $request->validate(
            [
                'up_department' => 'required|unique:departments,department,'.$request->up_id,
            ],
            [
                'up_department.required' => 'College is required.',
                'up_department.unique' => 'College already exists.',
            ]
        );

        $department = Department::find($request->up_id);
                if ($department) {
                    $department->department = $request->up_department;
                    $department->abbreviation = $request->up_abbreviation;
                    $department->save();
                    return response()->json([
                     'status' => 'success',
                 ]);
        } else {
                 return response()->json([
                     'status' => 'error',
                    'message' => 'Department not found',
                ], 404);
        }

    
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteDepartment(Request $request){
       Department::find($request->department_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }


      //view department
      public function viewDepartment(Request $request)
      {
          $department = Department::find($request->id);
          return response()->json($department);
      }
}
