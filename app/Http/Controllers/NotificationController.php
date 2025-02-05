<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\notificationmail;
use App\Models\Department;
use App\Models\Institute;
use App\Models\Logs;
use App\Models\NotifyTemplate;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class NotificationController extends Controller
{
    public function index()
    {
        $institutes = Institute::get();
        if (auth()->user()->role_id == 1) {
            $departments = Department::get();
        } elseif (auth()->user()->role_id == 2) {
            $departments = Department::where('institute_id', auth()->user()->institute_id)->get();
        } else {
            $departments = Department::where('id', auth()->user()->department_id)->first();
        }
        $template = NotifyTemplate::first();
        return view('notifications.notification', compact('institutes', 'template', 'departments'));
    }
    public function get_department($id)
    {

        $departments = Department::where('institute_id', $id)->get();

        return response()->json($departments);
    }
    public function send(Request $request)
    {
        try {
            $request->validate([
                'department' => 'required',
            ]);

            $students = Student::where('department_id', $request->department)->where('status', 1)->get();

            if ($request->method_0 == 1) {
                
                
                foreach ($students as $key => $student) {

                
                    foreach ($students as $key => $student) 
                    {
                        $email = $student->email;
                        $name = $student->name;
                        $ID = $student->id;
                        $message_text = $request->message;
                        Mail::to($email)->send(new notificationmail($name,$ID,$message_text));
                    }
                    // dispatch(new SendEmailJob($details));
                    Logs::create([
                        'admin_id' => auth()->user()->id,
                        'user_id' => $student->user_id,
                        'description' => 'Notification Sent Via Email',
                    ]);
                }
            }
            if ($request->method_1 == 1) {

                
                foreach ($students as $key => $student) {
                    if ($student->mobile) {
                        $receiverNumber = $student->mobile;
                        $message = $request->message;

                        $account_sid = env("TWILIO_SID");
                        $auth_token = env("TWILIO_AUTH_TOKEN");
                        $twilio_number = env("TWILIO_NUMBER");

                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiverNumber, [
                            'from' => $twilio_number,
                            'body' => $message
                        ]);
                        Logs::create([
                            'admin_id' => auth()->user()->id,
                            'user_id' => $student->user_id,
                            'description' => 'Notification Sent Via SMS',
                        ]);
                    }
                }
            }

            if ($request->method_0 == 0 && $request->method_1 == 0 && $request->method_2 == 0) {
                return redirect()->back()->with('error', 'Please Select a valid channel for notification');
            }

            return redirect()->back()->with('success', 'Notification has been Sent Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
