<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BrochureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Mail\UserRegistrationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
Route::get('/try', function () {
    return view('emails.notification');
    // $name='Oman';
    // $email='wemao;';
    // $pw='password@1234';
    // Mail::to('omanali909@gmail.com')->send(new UserRegistrationMail($name,$email,$pw));
    // dd('here');
});
Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Setting
Route::middleware('auth')->prefix('settings')->name('settings.')->group(function(){
    Route::get('/logo', [SettingController::class, 'site_logo'])->name('site_logo');
    Route::post('/logo/save', [SettingController::class, 'logo_store'])->name('logo_store');

    Route::get('/template', [SettingController::class, 'template'])->name('template');
    Route::post('/template/save', [SettingController::class, 'template_store'])->name('template_store');
});


// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::post('/update/department', [UserController::class, 'update_department'])->name('update_department');
    Route::get('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}', [UserController::class, 'updateStatus'])->name('status');
    Route::get('export/', [UserController::class, 'export'])->name('export');
});

// Institutes
Route::middleware('auth')->prefix('organization')->name('institute.')->group(function(){
    Route::get('/', [InstituteController::class, 'index'])->name('index');
    Route::post('/', [InstituteController::class, 'store'])->name('store');
    Route::post('/update', [InstituteController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [InstituteController::class, 'delete'])->name('delete');
    Route::get('/verify/{id}', [InstituteController::class, 'verify'])->name('verify');
    Route::post('/admission_period', [InstituteController::class, 'last_date'])->name('last_date');
});

// Department
Route::middleware('auth')->prefix('department')->name('department.')->group(function(){
    Route::get('/department', [DepartmentController::class, 'index'])->name('index');
    Route::get('/index', [DepartmentController::class, 'index_manager'])->name('index_manager');
    Route::post('/department', [DepartmentController::class, 'store'])->name('store');
    Route::post('/update', [DepartmentController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
    Route::get('/status_update/{id}', [InstituteController::class, 'status_update'])->name('status_update');
});

// Forms
Route::middleware('auth')->prefix('forms')->name('forms.')->group(function(){
    Route::get('/', [FormController::class, 'index'])->name('index');
    Route::get('/create', [FormController::class, 'create'])->name('create');
    Route::post('/save', [FormController::class, 'save'])->name('save');
    Route::get('/delete/{id}', [FormController::class, 'delete'])->name('delete');

});
// Student
Route::middleware('auth')->prefix('student')->name('student.')->group(function(){
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/application', [StudentController::class, 'application_index'])->name('application.index');
    Route::get('/add', [StudentController::class, 'add'])->name('add');
    Route::post('/by/add', [StudentController::class, 'admin_add'])->name('admin_add');
    Route::get('/department/{id}', [StudentController::class, 'get_department'])->name('department');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::post('/edit/application', [StudentController::class, 'update_user'])->name('update_user');
    Route::get('/view/{id}', [StudentController::class, 'view'])->name('view');
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::get('/admit_card', [StudentController::class, 'admit_card'])->name('admit_card');
    Route::post('/admit_card', [StudentController::class, 'admit_card_result'])->name('admit_card_result');
    Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('delete');
    Route::get('/download/application/{id}', [StudentController::class, 'dowload_application'])->name('dowload_application');
    Route::get('/download/admitcard/{id}', [StudentController::class, 'dowload_admit_card'])->name('dowload_admit_card');
    Route::post('/update/{id}', [StudentController::class, 'update'])->name('update');
    Route::get('/paid/free/{id}', [StudentController::class, 'paid_free'])->name('paid_free');
    Route::any('/filter', [StudentController::class, 'filter'])->name('filter');
});


// Attendance
Route::middleware('auth')->prefix('attendance')->name('attendance.')->group(function(){
    Route::get('/', [AttendanceController::class, 'index'])->name('index');
    Route::get('/absentess', [AttendanceController::class, 'absent'])->name('absent');
    Route::get('/add', [AttendanceController::class, 'mark_attendance'])->name('mark_attendance');
    Route::get('/attendance/marked/{id}', [AttendanceController::class, 'attendance_marked'])->name('attendance_marked');
    
});

// Notification
Route::middleware('auth')->prefix('notifications')->name('notifications.')->group(function(){
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::post('/send/notification', [NotificationController::class, 'send'])->name('send');

});

// Logs
Route::middleware('auth')->prefix('logs')->name('logs.')->group(function(){
    Route::get('/', [LogsController::class, 'index'])->name('index');
});

// Payment
Route::middleware('auth')->prefix('')->name('')->group(function(){

    Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index'])->name('razorpay');
    Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

});

// Brochures
Route::middleware('auth')->prefix('brochures')->name('brochures.')->group(function(){
    Route::get('/', [BrochureController::class, 'index'])->name('index');
    Route::post('/store', [BrochureController::class, 'store'])->name('store');
    Route::get('/delete/{id}', [BrochureController::class, 'delete'])->name('delete');

});