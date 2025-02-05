<?php

namespace App\Http\Controllers;

use App\Models\brochure;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Logs;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->status == '1') {
            if (auth()->user()->role_id == 1) {
                $students = Student::count();
                $institutes = Institute::count();
                $admission_processed = Student::where('status', 1)->count();

                $studentIds = Student::pluck('user_id')->all();
                $users = User::where('role_id', 4)
                ->whereNotIn('id', $studentIds)
                ->orderBy('created_at', 'desc')
                ->count();
            }
            if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
                $students = Student::where('institute_id', auth()->user()->institute_id)->count();
                $institutes = Department::where('institute_id', auth()->user()->institute_id)->count();
                $admission_processed = Student::where('institute_id', auth()->user()->institute_id)->where('status', 1)->count();

                if (auth()->user()->role_id == 2) {
                    $studentIds = Student::where('institute_id', auth()->user()->institute_id)
                        ->orderBy('created_at', 'desc')
                        ->pluck('user_id')
                        ->all();
                }
                if (auth()->user()->role_id == 3) {
                    $studentIds = Student::where('institute_id', auth()->user()->institute_id)
                        ->where('department_id', auth()->user()->department_id)
                        ->orderBy('created_at', 'desc')
                        ->pluck('user_id')
                        ->all();
                }
                $users = User::where('role_id', 4)
                    ->whereNotIn('id', $studentIds)
                    ->orderBy('created_at', 'desc')
                    ->count();
            }
            if (auth()->user()->role_id == 4) {
                $students = Department::where('id', auth()->user()->department_id)->first();
                $institutes = Department::where('institute_id', auth()->user()->institute_id)->get();
                $admission_processed = brochure::where('department_id', auth()->user()->department_id)->first();
                $users='';
            }


            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'User Logged In',
            ]);
            return view('home', compact('students', 'institutes', 'admission_processed','users'));
        } else {
            auth()->logout(); // Log out the user
            return abort(403); // Display 401 Unauthorized error
        }
    }

    /**
     * User Profile
     * @param Nill
     * @return View Profile

     */
    public function getProfile()
    {
        return view('profile');
    }

    /**
     * Update Profile
     * @param $profileData
     * @return Boolean With Success Message

     */
    public function updateProfile(Request $request)
    {
        #Validations
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'mobile_number' => 'required|numeric|digits:10',
        ]);

        try {
            DB::beginTransaction();

            #Update Profile Data
            User::whereId(auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
            ]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Profile Updated Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Change Password
     * @param Old Password, New Password, Confirm New Password
     * @return Boolean With Success Message

     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            DB::beginTransaction();

            #Update Password
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Password Changed Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
