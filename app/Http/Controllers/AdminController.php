<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Course;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function adminProfile()
    {
        $admin = Auth::user();
            return view('admin.profile', compact('admin'));
    }


  //admin edit profile
  public function editProfile($id)
  {
      $admin = Auth::user()->findOrFail($id);
      return view('admin.editProfile', compact('admin'));
  }

  public function updateProfile(Request $request, $id)
  {
      $admin = User::findOrFail($id);
  
      $admin->password = Hash::make($request->password);
      $admin->barangay = $request->barangay ?? $admin->barangay;
      $admin->municipal = $request->municipal ?? $admin->municipal;
      $admin->province = $request->province ?? $admin->province;
      $admin->contact = $request->contact ?? $admin->contact;
  
      $admin->save();
  
      return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
  }
  
    public function users()
    {
        $users = User::orderBy('name')->paginate(10);
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
            User::where('user_type', 'instructor')->count(),
            User::where('user_type', 'counselor')->count(),
            User::where('user_type', 'admin')->count(),
        ];
        $courses = Course::all();
        $departments = Department::all();
        
        return view('admin.users',compact('users','courses','departments', 'userTypeCounts'));
    }

    public function students()
    {
        $users = User::all();
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
            User::where('user_type', 'instructor')->count(),
            User::where('user_type', 'counselor')->count(),
        ];
        $students = User::where('user_type', 'student')->orderBy('name')->paginate(10);
        $courses = Course::all();
        $departments = Department::all();
        return view('admin.studentlist', compact ('students','userTypeCounts','courses','departments'));
    }

    public function instructors()
    {
        $users = User::all();
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
            User::where('user_type', 'instructor')->count(),
            User::where('user_type', 'counselor')->count(),
            User::where('user_type', 'admin')->count(),
        ];
        $instructors = User::where('user_type', 'instructor')->orderBy('name')->paginate(10);
        $courses = Course::all();
        $departments = Department::all();
        return view('admin.instructorlist', compact ('instructors', 'userTypeCounts','courses','departments'));
    }

    public function admins()
    {
        $users = User::all();
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
            User::where('user_type', 'instructor')->count(),
            User::where('user_type', 'counselor')->count(),
            User::where('user_type', 'admin')->count(),
        ];
        $admins = User::where('user_type', 'admin')->orderBy('name')->paginate(10);
        $courses = Course::all();
        $departments = Department::all();
        return view('admin.adminlist', compact ('admins', 'userTypeCounts','courses','departments'));
    }


    public function counselors()
    {
        $users = User::all();
        $userTypeCounts = [
            User::where('user_type', 'student')->count(),
            User::where('user_type', 'instructor')->count(),
            User::where('user_type', 'counselor')->count(),
        ];
        $counselors = User::where('user_type', 'counselor')->orderBy('name')->get();
        $courses = Course::all();
        $departments = Department::all();
        return view('admin.counselorlist', compact('counselors','userTypeCounts','courses','departments'));
    }

    
    public function addUser(Request $request){
        
        $request->validate(
        [
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required|confirmed',
        'user_type' => ['required', 'string', 'in:admin,counselor,instructor,student'],
        ],
        [
        'name.required' => 'Name is required.',
        'email.required' => 'Email is required.',
        'email.unique' => 'Email already exists.',
        'password.required' => 'Password is required.',
        'password.confirmed' => 'Password did not match.',
        'user_type.required' => 'User type is required.',
        ]
        );
       
        $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->year_level = $request->year_level;
            $user->course_id = $request->course_id;
            $user->department_id = $request->department_id;
            $user->barangay = $request->barangay;
            $user->municipal = $request->municipal;
            $user->province = $request->province;
            $user->contact = $request->contact;
            $user->password = Hash::make($request->password);
            $user->user_type = $request->user_type;
            $user->profile_image = $request->profile_image;

           
            $user->save();

           
            
          
            return response()->json([
                    'status'=>'success',
            ]);
           
        } 

        //view student
        public function viewStudent($id)
        {
            $student = User::where('user_type', 'student')->find($id);
        
            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }
        
            return response()->json($student);
        }
        


         // Update student
        public function updateStudent(Request $request)
        {
            $request->validate([
                'up_name' => 'required|unique:users,name,' . $request->up_id,
                'up_email' => 'required|unique:users,email,' . $request->up_id,
                'up_password' => 'nullable|confirmed',
                'up_user_type' => ['required', 'string', 'in:admin,counselor,instructor,student'],
            ], [
                'up_name.required' => 'Name is required.',
                'up_name.unique' => 'Name already exists.',
                'up_email.required' => 'Email is required.',
                'up_email.unique' => 'Email already exists.',
                'up_password.confirmed' => 'The password confirmation does not match.',
                'up_user_type.required' => 'User type is required.',
            ]);

            $student = User::where('user_type', 'student')->find($request->up_id);

            if (!$student) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            $student->name = $request->up_name;
            $student->email = $request->up_email;
            $student->year_level = $request->up_year_level;
            $student->course_id = $request->up_course_id;
            $student->department_id = $request->up_department_id;
            $student->barangay = $request->up_barangay;
            $student->municipal = $request->up_municipal;
            $student->province = $request->up_province;
            $student->contact = $request->up_contact;

            if ($request->has('up_password')) {
                $student->password = bcrypt($request->up_password);
            }

            $student->user_type = $request->up_user_type;
            $student->save();

            return response()->json([
                'status' => 'success',
            ]);
        }

        //delete student
        public function deleteStudent(Request $request)
        {
            User::where('user_type', 'student')->where('id', $request->student_id)->delete();
            return response()->json([
                'status' => 'success',
            ]);
        }

        //view instructor
        public function viewInstructor($id)
        {
            $instructor = User::where('user_type', 'instructor')->find($id);
            
            if (!$instructor) {
                return response()->json(['error' => 'Instructor not found'], 404);
            }
            
            return response()->json($instructor);
        }
        
            // Update instructor
            public function updateInstructor(Request $request)
            {
                $request->validate([
                    'up_name' => 'required|unique:users,name,' . $request->up_id,
                    'up_email' => 'required|unique:users,email,' . $request->up_id,
                    'up_password' => 'nullable|confirmed',
                    'up_user_type' => ['required', 'string', 'in:admin,counselor,instructor,student'],
                ], [
                    'up_name.required' => 'Name is required.',
                    'up_name.unique' => 'Name already exists.',
                    'up_email.required' => 'Email is required.',
                    'up_email.unique' => 'Email already exists.',
                    'up_password.confirmed' => 'The password confirmation does not match.',
                    'up_user_type.required' => 'User type is required.',
                ]);
    
                $instructor = User::where('user_type', 'instructor')->find($request->up_id);
    
                if (!$instructor) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'User not found',
                    ], 404);
                }
    
                $instructor->name = $request->up_name;
                $instructor->email = $request->up_email;
                $instructor->year_level = $request->up_year_level;
                $instructor->course_id = $request->up_course_id;
                $instructor->department_id = $request->up_department_id;
                $instructor->barangay = $request->up_barangay;
                $instructor->municipal = $request->up_municipal;
                $instructor->province = $request->up_province;
                $instructor->contact = $request->up_contact;
    
                if ($request->has('up_password')) {
                    $instructor->password = bcrypt($request->up_password);
                }
    
                $instructor->user_type = $request->up_user_type;
                $instructor->save();
    
                return response()->json([
                    'status' => 'success',
                ]);
            }
    
             //delete instructor
        public function deleteInstructor(Request $request)
        {
            User::where('user_type', 'instructor')->where('id', $request->instructor_id)->delete();
            return response()->json([
                'status' => 'success',
            ]);
        }


         //view counselor
         public function viewCounselor($id)
         {
             $counselor = User::where('user_type', 'counselor')->find($id);
             
             if (!$counselor) {
                 return response()->json(['error' => 'Counselor not found'], 404);
             }
             
             return response()->json($counselor);
         }

             // Update counselor
             public function updateCounselor(Request $request)
             {
                 $request->validate([
                     'up_name' => 'required|unique:users,name,' . $request->up_id,
                     'up_email' => 'required|unique:users,email,' . $request->up_id,
                     'up_password' => 'nullable|confirmed',
                     'up_user_type' => ['required', 'string', 'in:admin,counselor,instructor,student'],
                 ], [
                     'up_name.required' => 'Name is required.',
                     'up_name.unique' => 'Name already exists.',
                     'up_email.required' => 'Email is required.',
                     'up_email.unique' => 'Email already exists.',
                     'up_password.confirmed' => 'The password confirmation does not match.',
                     'up_user_type.required' => 'User type is required.',
                 ]);
     
                 $counselor = User::where('user_type', 'counselor')->find($request->up_id);
     
                 if (!$counselor) {
                     return response()->json([
                         'status' => 'error',
                         'message' => 'User not found',
                     ], 404);
                 }
     
                 $counselor->name = $request->up_name;
                 $counselor->email = $request->up_email;
                 $counselor->year_level = $request->up_year_level;
                 $counselor->course_id = $request->up_course_id;
                 $counselor->department_id = $request->up_department_id;
                 $counselor->barangay = $request->up_barangay;
                 $counselor->municipal = $request->up_municipal;
                 $counselor->province = $request->up_province;
                 $counselor->contact = $request->up_contact;
     
                 if ($request->has('up_password')) {
                     $counselor->password = bcrypt($request->up_password);
                 }
     
                 $counselor->user_type = $request->up_user_type;
                 $counselor->save();
     
                 return response()->json([
                     'status' => 'success',
                 ]);
             }

             
      //delete counselor
      public function deleteCounselor(Request $request)
      {
          User::where('user_type', 'counselor')->where('id', $request->counselor_id)->delete();
          return response()->json([
              'status' => 'success',
          ]);
      }

       //view admin
       public function viewAdmin($id)
       {
           $admin = User::where('user_type', 'admin')->find($id);
       
           if (!$admin) {
               return response()->json(['error' => 'Admin not found'], 404);
           }
       
           return response()->json($admin);
       }

        // Update admin
        public function updateAdmin(Request $request)
        {
            $request->validate([
                'up_name' => 'required|unique:users,name,' . $request->up_id,
                'up_email' => 'required|unique:users,email,' . $request->up_id,
                'up_password' => 'nullable|confirmed',
                'up_user_type' => ['required', 'string', 'in:admin,counselor,instructor,student'],
            ], [
                'up_name.required' => 'Name is required.',
                'up_name.unique' => 'Name already exists.',
                'up_email.required' => 'Email is required.',
                'up_email.unique' => 'Email already exists.',
                'up_password.confirmed' => 'The password confirmation does not match.',
                'up_user_type.required' => 'User type is required.',
            ]);

            $admin = User::where('user_type', 'admin')->find($request->up_id);

            if (!$admin) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Admin not found',
                ], 404);
            }

            $admin->name = $request->up_name;
            $admin->email = $request->up_email;
            $admin->year_level = $request->up_year_level;
            $admin->course_id = $request->up_course_id;
            $admin->department_id = $request->up_department_id;
            $admin->barangay = $request->up_barangay;
            $admin->municipal = $request->up_municipal;
            $admin->province = $request->up_province;
            $admin->contact = $request->up_contact;

            if ($request->has('up_password')) {
                $admin->password = bcrypt($request->up_password);
            }

            $admin->user_type = $request->up_user_type;
            $admin->save();

            return response()->json([
                'status' => 'success',
            ]);
        }

         //delete admin
        public function deleteAdmin(Request $request)
        {
            User::where('user_type', 'admin')->where('id', $request->admin_id)->delete();
            return response()->json([
                'status' => 'success',
            ]);
        }

            //view user acc
        public function viewUser(Request $request)
        {
            $user = User::find($request->id);
            return response()->json($user);
        }
        

         //update user acc
         public function updateUser(Request $request)
         {
             $request->validate([
                 'up_name' => 'required|unique:users,name,'.$request->up_id,
                 'up_email' => 'required|unique:users,email,'.$request->up_id,
                 'up_password' => 'required|confirmed',
                 'up_user_type' => ['required', 'string', 'in:admin,counselor,instructor,student'],
             
             ],
             [
                 'up_name.required' => 'Name is required.',
                 'up_name.unique' => 'Name already exists.',
                 'up_email.required' => 'Email is required.',
                 'up_email.unique' => 'Email already exists.',
                 'up_password.required' => 'Password is required.',
                 'up_password.confirmed' => 'The password did not match.',
                 'up_user_type.required' => 'User type is required.',
            
             ]);
         
             $user = User::find($request->up_id);
         
             if ($user) {
                 $user->name = $request->up_name;
                 $user->email = $request->up_email;
                 $user->year_level = $request->up_year_level;
                 $user->course_id = $request->up_course_id;
                 $user->department_id = $request->up_department_id;
                 $user->barangay = $request->up_barangay;
                 $user->municipal = $request->up_municipal;
                 $user->province = $request->up_province;
                 $user->contact = $request->up_contact;
                 $user->password = bcrypt($request->input('up_password'));
                 $user->user_type = $request->up_user_type;

                 $user->save();
         
                 return response()->json([
                     'status' => 'success',
                 ]);
             } else {
                 return response()->json([
                     'status' => 'error',
                     'message' => 'User not found',
                 ], 404);
             }
         }
         
    
    //delete user acc
    
        public function deleteUser(Request $request){
            User::find($request->user_id)->delete();
            return response()->json([
                'status' => 'success',
            ]);
        }

public function import(Request $request)
{
  
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $file = fopen($request->file('file')->getPathname(), 'r');

    while (($row = fgetcsv($file)) !== false) {
        $user = new User;
        $user->name = $row[0];
        $user->email = $row[1];
        $user->user_type = $request->input('user_type');
        $user->password = Hash::make('password123'); 
        $user->save();
    }

    
    fclose($file);

   
    return back()->with('success', 'Users imported successfully!');
}

}
