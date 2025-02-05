<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        if(auth()->user()->role_id==2){
            $students = Student::where('institute_id',auth()->user()->institute_id)->orderBy('created_at', 'desc')->where('attendance','1')->get();
        }elseif(auth()->user()->role_id==3){
            
            $students = Student::where('institute_id',auth()->user()->institute_id)->where('department_id',auth()->user()->department_id)->orderBy('created_at', 'desc')->where('attendance','1')->get();
        }else{
            $students = Student::where('attendance','1')->orderBy('created_at', 'desc')->get();
        }
        foreach($students as $key=>$student){
            $students[$key]['attendance_by']=User::where('id',$student->attendance_taken_by)->pluck('name')->first();
        }
        $institutes=Institute::get();
        return view('reports.attendance', compact('students','institutes'));
    }
    public function absent(){
        if(auth()->user()->role_id==2){
            $students = Student::where('institute_id',auth()->user()->institute_id)->orderBy('created_at', 'desc')->where('attendance','0')->get();
        }elseif(auth()->user()->role_id==3){
            
            $students = Student::where('institute_id',auth()->user()->institute_id)->where('department_id',auth()->user()->department_id)->orderBy('created_at', 'desc')->where('attendance','0')->get();
        }else{
            $students = Student::orderBy('created_at', 'desc')->get();
        }
        $institutes=Institute::get();
        return view('reports.absent', compact('students','institutes'));
    }
    public function mark_attendance(){
      
        return view('reports.mark_attendance');
    }
    public function attendance_marked($id){
        if(auth()->user()->role_id == 1){
            $update=Student::where('id',$id)->first();
            $update->attendance=1;
            $update->attendance_time=now();
            $update->attendance_taken_by=auth()->user()->id;
            $update->save();
        }
        elseif(auth()->user()->role_id == 2){
            $update=Student::where('id',$id)->first();
            if($update->institute_id == auth()->user()->institute_id){
                $update->attendance=1;
                $update->attendance_time=now();
                $update->attendance_taken_by=auth()->user()->id;
                $update->save();
            }else{
                return redirect()->back()->with('error','Record Not Found');
            }
           
        }elseif(auth()->user()->role_id == 3){
            $update=Student::where('id',$id)->first();
            if($update->institute_id == auth()->user()->institute_id && $update->department_id == auth()->user()->department_id){
                $update->attendance=1;
                $update->attendance_time=now();
                $update->attendance_taken_by=auth()->user()->id;
                $update->save();
            }else{
                return redirect()->back()->with('error','Record Not Found');
            }

        }else{

            return redirect()->back()->with('error','Record Not Found');
        }
    }
}
