<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CallslipController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NotificationController;
use Spatie\GoogleCalendar\Event;
//use App\Events\UserLogin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');







Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/adminAccount', [AdminController::class, 'ownAccount'])->name('own-account');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('add-user', [AdminController::class, 'addUser'])->name('add.user');
    Route::post('update-user', [AdminController::class, 'updateUser'])->name('update.user');
    Route::post('/delete-user', [AdminController::class, 'deleteUser'])->name('delete.user');
    Route::get('/admin/user/{id}', [AdminController::class, 'viewUser']);

    Route::get('/admin/studentlist', [AdminController::class, 'students'])->name('admin.studentlist');
    Route::get('/admin/student/{id}', [AdminController::class, 'viewStudent']);
    Route::post('update-student', [AdminController::class, 'updateStudent'])->name('update.student');
    Route::post('/delete-student', [AdminController::class, 'deleteStudent'])->name('delete.student');

    Route::get('/admin/instructorlist', [AdminController::class, 'instructors'])->name('admin.instructorlist');
    Route::get('/admin/instructor/{id}', [AdminController::class, 'viewInstructor']);
    Route::post('update-instructor', [AdminController::class, 'updateInstructor'])->name('update.instructor');
    Route::post('/delete-instructor', [AdminController::class, 'deleteInstructor'])->name('delete.instructor');

    Route::get('/admin/counselorlist', [AdminController::class, 'counselors'])->name('admin.counselorlist');
    Route::get('/admin/counselor/{id}', [AdminController::class, 'viewCounselor']);
    Route::post('update-counselor', [AdminController::class, 'updateCounselor'])->name('update.counselor');
    Route::post('/delete-counselor', [AdminController::class, 'deleteCounselor'])->name('delete.counselor');

    Route::get('/admin/adminlist', [AdminController::class, 'admins'])->name('admin.adminlist');
    Route::get('/admin/admin/{id}', [AdminController::class, 'viewAdmin']);
    Route::post('update-admin', [AdminController::class, 'updateAdmin'])->name('update.admin');
    Route::post('/delete-admin', [AdminController::class, 'deleteAdmin'])->name('delete.admin');

    Route::get('/admin/reasons', [ReasonController::class, 'reasons'])->name('reasons');
    Route::post('add-reason', [ReasonController::class, 'addReason'])->name('add.reason');
    Route::post('update-reason', [ReasonController::class, 'updateReason'])->name('update.reason');
    Route::post('/delete-reason', [ReasonController::class, 'deleteReason'])->name('delete.reason');
    Route::get('/admin/reason/{id}', [ReasonController::class, 'viewReason']);
    
    Route::get('/admin/departments', [DepartmentController::class, 'departments'])->name('departments');
    Route::post('add-department', [DepartmentController::class, 'addDepartment'])->name('add.department');
    Route::post('update-department', [DepartmentController::class, 'updateDepartment'])->name('update.department');
    Route::post('/delete-department', [DepartmentController::class, 'deleteDepartment'])->name('delete.department');
    Route::get('/admin/department/{id}', [DepartmentController::class, 'viewDepartment']);


    Route::get('/admin/courses', [CourseController::class, 'courses'])->name('courses');
    Route::post('add-course', [CourseController::class, 'addCourse'])->name('add.course');
    Route::get('/get-courses/{department_id}', [CourseController::class, 'getCoursesByDepartment']);
    Route::post('update-course', [CourseController::class, 'updateCourse'])->name('update.course');
    Route::post('/delete-course', [CourseController::class, 'deleteCourse'])->name('delete.course');
    Route::get('/admin/course/{id}', [CourseController::class, 'viewCourse']);

    Route::get('/admin/adminSearch', [SearchController::class, 'adminSearch'])->name('adminSearch');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::get('admin/editProfile/{id}', [AdminController::class, 'editProfile'])->name('admin.editProfile');
    Route::put('/admin/profile/{id}', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');

    Route::post('/import/users', [AdminController::class, 'import'])->name('import.users');




});



Route::middleware(['auth','web'])->group(function () {
    Route::get('/instructor/dashboard', [DashboardController::class, 'instructorDashboard'])->name('instructor.dashboard');
   // Route::get('/instructor/referrals', [DashboardController::class, 'instructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/referrals', [InstructorController::class, 'referrals'])->name('instructor.referrals');
    //Route::get('/instructor/referral/{id}', [InstructorController::class, 'viewReferral']);
    //Route::get('/referral/{id}', [InstructorController::class, 'showReferralDetails'])->name('instructor.view_referral');
    Route::post('add-referral', [InstructorController::class, 'addReferral'])->name('add.referral');
    Route::post('update-referral', [InstructorController::class, 'updateReferral'])->name('update.referral');
    Route::get('/instructor/view_referral/{id}', [InstructorController::class, 'getReferral'])->name('instructor.view_referral');
    Route::get('/instructor/instructorSearch', [SearchController::class, 'instructorSearch'])->name('instructorSearch');
    Route::post('/delete-referral', [InstructorController::class, 'deleteReferral'])->name('delete.referral');
    Route::get('/instructor/profile', [InstructorController::class, 'instructorProfile'])->name('instructor.profile');
    Route::get('instructor/editProfile/{id}', [InstructorController::class, 'editProfile'])->name('instructor.editProfile');
    Route::put('/instructor/profile/{id}', [InstructorController::class, 'updateProfile'])->name('instructor.updateProfile');
    Route::get('/instructor/studentslist', [InstructorController::class, 'students'])->name('instructor.studentslist');
    
    Route::get('/instructor/notifications', [InstructorController::class, 'showNotification'])->name('instructor.notifications');
    Route::post('/instructor/notifications/markAsRead', [InstructorController::class, 'markAsRead'])->name('instructor.notifications.markAsRead');
    Route::delete('/instructor/notifications/delete-all', [InstructorController::class, 'deleteAll'])->name('instructor.notifications.deleteAll');
    Route::delete('/instructor/notifications/{id}', [InstructorController::class, 'deleteNotification'])->name('instructor.notifications.delete');
   
});


Route::middleware(['auth','web'])->group(function () {
    Route::get('/counselor/dashboard', [DashboardController::class, 'counselorDashboard'])->name('counselor.dashboard');
    Route::get('/counselor/callslips', [CallslipController::class, 'callslips'])->name('counselor.callslips');
    Route::post('/counselor/add-callslip/{referral_id}', [CallslipController::class, 'addCallslip'])->name('add.callslip');
    Route::post('add-callslip', [CallslipController::class, 'addCallslip'])->name('add.callslip');
    Route::get('/counselor/callslip/{id}', [CounselorController::class, 'viewCallslip']);
    Route::post('create-callslip-btn', [CallslipController::class, 'store'])->name('callslip.store');
    Route::post('update-callslip', [CallslipController::class, 'updateCallslip'])->name('update.callslip');
    Route::post('/delete-callslip', [CallslipController::class, 'deleteCallslip'])->name('delete.callslip');
    Route::get('/callslips/{id}/complete', [CallSlipController::class, 'completeCallSlip'])->name('callslip.complete');
    Route::get('callslips/{id}/cancel', [CallslipController::class, 'cancelCallSlip'])->name('callslip.cancel');
    Route::get('/counselor/counselorSearch', [SearchController::class, 'counselorSearch'])->name('counselorSearch');
    Route::get('/counselor/profile', [CounselorController::class, 'counselorProfile'])->name('counselor.profile');
    Route::get('counselor/editProfile/{id}', [CounselorController::class, 'editProfile'])->name('counselor.editProfile');
    Route::put('/counselor/profile/{id}', [CounselorController::class, 'updateProfile'])->name('counselor.updateProfile');


    Route::get('/counselor/callslip/{id}', [CounselorController::class, 'viewCallslip']);
  
    //Route::post('/get-referral', 'ReferralController@getReferral')->name('get.referral');
    Route::get('/referrals/{id}/approve', [CounselorController::class, 'approvedReferral'])->name('referral.approve');
    //Route::get('/counselor/callslips/{id}', 'App\Http\Controllers\CallslipController@viewCallslip')->name('counselor.view_callslip');
    Route::get('/counselor/referrals', [CounselorController::class, 'referrals'])->name('counselor.referrals');
    //Route::get('/referrals/{referral_id}', [CounselorController::class, 'viewReferral'])->name('viewReferral');
    Route::delete('referrals/{id}', [CounselorController::class, 'destroy'])->name('deleteReferral');
    //Route::get('/counselor/referral/{id}', [CounselorController::class, 'viewReferral']);
    Route::get('/counselor/view_referral/{id}', [CounselorController::class, 'getReferral'])->name('counselor.view_referral');
    //Route::get('/counselor/view-referral/{referral_id}', 'App\Http\Controllers\CounselorController@viewReferral');
    Route::get('/counselor/view-referral/{id}', [CounselorController::class, 'viewReferral'])->name('counselor.view-referral');
    Route::get('/counselor/view-callslip/{id}', [CounselorController::class, 'getCallslip'])->name('counselor.view-callslip');
    Route::get('/counselor/instructorslist', [CounselorController::class, 'instructors'])->name('counselor.instructorslist');
    Route::get('/counselor/studentslist', [CounselorController::class, 'students'])->name('counselor.studentslist');
    Route::get('/counselor/records', [CounselorController::class, 'records'])->name('counselor.records');
    Route::post('/delete-referral', [CounselorController::class, 'deleteReferral'])->name('delete.referral');
    Route::post('add-note', [CounselorController::class, 'addNote'])->name('add.note');

    Route::get('/counselor/availability', [CounselorController::class, 'availability'])->name('counselor.availability');
    Route::post('add-availability', [CounselorController::class, 'addAvailability'])->name('add.availability');
    Route::delete('/counselor/availability/{id}', [CounselorController::class, 'deleteAvailability'])->name('counselor.deleteAvailability');
    Route::post('/delete-availability', [CounselorController::class, 'deleteAvailability'])->name('delete.availability');


    Route::get('/counselor/notifications', [CounselorController::class, 'showNotification'])->name('counselor.notifications');
    Route::post('/counselor/notifications/markAsRead', [CounselorController::class, 'markAsRead'])->name('counselor.notifications.markAsRead');
    Route::delete('/counselor/notifications/delete-all', [CounselorController::class, 'deleteAll'])->name('counselor.notifications.deleteAll');
    Route::delete('/counselor/notifications/{id}', [CounselorController::class, 'deleteNotification'])->name('counselor.notifications.delete');
});

Route::middleware(['auth','web'])->group(function () {
    Route::get('/student/home', [StudentController::class, 'appointmentHistory'])->name('student.home');
    Route::get('/student/profile', [StudentController::class, 'studentProfile'])->name('student.profile');
    Route::get('/student/studentSearch', [SearchController::class, 'studentSearch'])->name('studentSearch');
    Route::get('student/editProfile/{id}', [StudentController::class, 'editProfile'])->name('student.editProfile');
    Route::put('/student/profile/{id}', [StudentController::class, 'updateProfile'])->name('student.updateProfile');

    Route::get('/student/referrals', [StudentController::class, 'referrals'])->name('student.referrals');
    Route::get('/student/view_referral/{id}', [StudentController::class, 'getReferral'])->name('student.view_referral');
    Route::post('add-referral', [StudentController::class, 'addReferral'])->name('add.referral');

    Route::get('/mark-as-read', [App\Http\Controllers\CallslipController::class,'markAsRead'])->name('mark-as-read');
    Route::get('/student/callslips', [StudentController::class, 'callslips'])->name('student.callslips');
    Route::get('/student/callslip/{id}', [StudentController::class, 'viewCallslip']);
    //Route::get('/student/callslips/{id}', 'App\Http\Controllers\StudentController@showCallslip')->name('student.view_callslips');
    Route::get('/student/notifications', [StudentController::class, 'showNotification'])->name('student.notifications');
    Route::post('/student/notifications/markAsRead', [StudentController::class, 'markAsRead'])->name('student.notifications.markAsRead');
    Route::delete('/student/notifications/{id}', [StudentController::class, 'deleteNotification'])->name('student.notifications.delete');
    Route::delete('/student/notifications/delete-all', [StudentController::class, 'deleteAll'])->name('student.notifications.deleteAll');
});

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
Route::post('/password/reset', [ResetPasswordController::class, 'update'])->name('password.update');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


//Route::post('/login', function () {
    //$name = request()->name;

    //event(new UserLogin($name));
//});
