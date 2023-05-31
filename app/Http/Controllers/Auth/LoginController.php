<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Events\UserLogin;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/login';

    protected function authenticated(Request $request, $user)
    {
        if ($user->user_type == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->user_type == 'counselor') {
            return redirect()->route('counselor.dashboard');
        } elseif ($user->user_type == 'instructor') {
            return redirect()->route('instructor.dashboard');
        } elseif ($user->user_type == 'student') {
            return redirect()->route('student.home');
        } else {
            return redirect('/login');
        }

        $name = $user->name;
        event(new UserLogin($name));
    }

     public function showLoginForm()
     {
         return view('auth.login');
     }
     
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    
}
 
