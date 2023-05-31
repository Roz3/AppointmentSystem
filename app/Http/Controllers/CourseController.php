<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;

class CourseController extends Controller
{
    public function courses()
    {
        $courses =Course::latest()->paginate(5);
        $coursesCount = Course::count();
        $departments = Department::all();
        return view('/admin/courses',compact('courses','departments','coursesCount'));
    }

    public function addCourse(Request $request)
    {
        $request->validate([
            'course' => 'required|unique:courses',
        ], [
            'course.required' => 'Course is required.',
            'course.unique' => 'Course already exists.',
        ]);
    
        $course = new Course();
        $course->course = $request->course;
        $course->abbreviation = $request->abbreviation;
        $course->department_id = $request->department_id;
        $course->save();
    
        return response()->json([
            'status' => 'success',
        ]);
    }
    

    public function getCourses($department_id) {
        $courses = Course::where('department_id', $department_id)->get();
        return response()->json($courses);
    }
    
    //update

    public function updateCourse(Request $request){
        $request->validate(
            [
                'up_course' => 'required|unique:courses,course,'.$request->up_id,
            ],
            [
                'up_course.required' => 'Course is required.',
                'up_course.unique' => 'Course already exists.',
            ]
        );

        $course = Course::find($request->up_id);
                if ($course) {
                    $course->course = $request->up_course;
                    $course->abbreviation = $request->up_abbreviation;
                    $course->department_id = $request->up_department_id;
                    $course->save();
                    return response()->json([
                     'status' => 'success',
                 ]);
        } else {
                 return response()->json([
                     'status' => 'error',
                    'message' => 'Course not found.',
                ], 404);
        }

    
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteCourse(Request $request){
       Course::find($request->course_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

       //view course
       public function viewCourse(Request $request)
       {
           $course = Course::find($request->id);
           return response()->json($course);
       }
}
