<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistrationMail;
use App\Models\Department;
use App\Models\FormData;
use App\Models\FormDataResult;
use App\Models\Institute;
use App\Models\Logs;
use App\Models\PaymentLog;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Calculation\Database\DStDev;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class StudentController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id==2){
            $studentIds = Student::where('institute_id', auth()->user()->institute_id)
                    ->orderBy('created_at', 'desc')
                    ->pluck('user_id')
                    ->all();

           
            
        }elseif(auth()->user()->role_id==3){
            $studentIds = Student::where('institute_id', auth()->user()->institute_id)
                        ->where('department_id',auth()->user()->department_id)
                    ->orderBy('created_at', 'desc')
                    ->pluck('user_id')
                    ->all();

        }
        else{
            $studentIds = Student::pluck('user_id')->all();
           
        }
        $students = User::where('role_id', 4)
        ->whereNotIn('id', $studentIds)
        ->orderBy('created_at', 'desc')
        ->get();
        foreach($students as $key=>$student){
            $students[$key]['institute']=Institute::where('id',$student->institute_id)->pluck('name')->first();
            $students[$key]['department']=Department::where('id',$student->department_id)->pluck('name')->first();
        }
            $institutes=Institute::get();
            return view('student.index', compact('students','institutes'));
    }
    public function application_index()
    {
       
            $students = Student::get();
            
             $institutes=Institute::get();
            return view('student.applications', compact('students','institutes'));
    }
    public function add()
    {   
        if(auth()->user()->role_id==1){
            $institutes = Institute::get();
            $departments = Department::get();
        }else{
            $institutes = Institute::where('id',auth()->user()->institute_id)->first();
            $departments = Department::where('id',auth()->user()->department_id)->first();
            $user=User::where('id',auth()->user()->id)->first();
            $additional_fields=FormData::where('institute_id',auth()->user()->institute_id)->get();
            $count=count($additional_fields);
        }
        if(auth()->user()->role_id==3){
            $departments = Department::where('institute_id',auth()->user()->institute_id)->where('id',auth()->user()->department_id)->get();
        }
        
    
        return view('student.add', compact('institutes', 'departments','additional_fields','count','user'));
    }
    public function admin_add(Request $request)
    
        {
            $user=User::where('id',$request->user_id)->first();
            $institutes = Institute::where('id',$request->id)->first();
            $departments = Department::where('id',$request->department_id)->first(); 
            $additional_fields=FormData::where('institute_id',$request->id)->get();
            $count=count($additional_fields);
            return view('student.add', compact('institutes', 'departments','additional_fields','count','user'));
    }
    public function get_department($id)
    {

        $departments = Department::where('institute_id', $id)->get();

        return response()->json($departments);
    }
    public function store(Request $request)
    {
     
        if ($request->user_id) {
            $user_id = $request->user_id;
        } else {
            $request->validate([
                'email' => 'required|email|unique:users,email|max:255',
            ]);
            $user = User::create([
                'name' => $request->fullname,
                'email' =>  $request->email,
                'password' => Hash::make('password@1234'),
                'role_id' => 4,
                'status' => 1,
            ]);

            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' =>  $user->id,
                'description' => 'User Added',

            ]);
            // Assign role to the user
            $user->assignRole($user->role_id);
            $user_id = $user->id;


          
        }
        
        //Validate the incoming request data
        $request->validate([
            'imageUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'institute' => 'required',
            'department' => 'required',
            'fullname' => 'required',
            'dob' => 'required',
            'nationality' => 'required',
            'fathername' => 'required',
            'mothername' => 'required',
            'address' => 'required',
            'city' => 'required',
            'district' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'email' => 'required|email|unique:students,email|max:255',
            'mobile' => 'nullable|unique:students,mobile|max:255',
            'aadhar' => 'required|mimes:pdf|max:6144',
            'sslc' => 'nullable|mimes:pdf|max:6144',
            'academic' => 'nullable|mimes:pdf|max:6144',
            'signature' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'islamicstudy' => 'required',
            'secularstudy' => 'required',
            'islamicyear' => 'required',
            'secularyear' => 'required',
            'grade' => 'required',
           
        ]);
        DB::beginTransaction();
        try {
            if ($request->motheroccupation == 'other') {
                $motheroccupation = $request->otheroccupation;
            } else {
                $motheroccupation = $request->motheroccupation;
            }

            if ($request->hasFile('imageUpload') && $request->file('imageUpload')->isValid()) {
                $profile = time() . '.' . $request->imageUpload->extension();
                $request->imageUpload->move(public_path('profile'), $profile);
            }
            if ($request->hasFile('aadhar') && $request->file('aadhar')->isValid()) {
                $aadhar = time() . '.' . $request->aadhar->extension();
                $request->aadhar->move(public_path('aadhar'), $aadhar);
            }
            if ($request->hasFile('sslc') && $request->file('sslc')->isValid()) {
                $sslc = time() . '.' . $request->sslc->extension();
                $request->sslc->move(public_path('sslc'), $sslc);
            }
            if ($request->hasFile('academic') && $request->file('academic')->isValid()) {
                $academic = time() . '.' . $request->academic->extension();
                $request->academic->move(public_path('academic'), $academic);
            }
            if ($request->hasFile('signature') && $request->file('signature')->isValid()) {
                $signature = time() . '.' . $request->signature->extension();
                $request->signature->move(public_path('signature'), $signature);
            }
           
            $user=Student::create([
                'user_id' => $user_id,
                'institute_id' => $request->institute,
                'department_id' => $request->department,
                'profile_photo' => $profile,
                'name' => $request->fullname,
                'email' => $request->email,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'nationality' => $request->nationality,
                'religion' => $request->religion,
                'father_name' => $request->fathername,
                'father_occupation' => $request->fatheroccupation,
                'mother_name' => $request->mothername,
                'mother_occupation' => $motheroccupation,
                'address' => $request->address,
                'city' => $request->city,
                'district' => $request->district,
                'state' => $request->state,
                'pin' => $request->pincode,
                'mobile' => $request->phone,
                'aadhar' => $aadhar,
                'sslc' => $sslc ?? null,
                'previous_certificate' => $academic ?? null,
                'islamic_qualfication' => $request->islamicstudy,
                'islamic_year' => $request->islamicyear,
                'secular_qualfication' => $request->secularstudy,
                'secular_year' => $request->secularyear,
                'previous_education' => $request->previous_education ?? 0,
                'previous_education_details' => $request->previous_education_details,
                'aim_1' => $request->aim1,
                'aim_2' => $request->aim2,
                'aim_3' => $request->aim3,
                'hobbies' => $request->hobbies_interests,
                'activites' => $request->extracurricular_activities,
                'signature' => $signature,
                'status' =>0,
                'free' =>0,
                'grade' =>$request->grade,

            ]);
            if($request->extra_fields){
                foreach($request->extra_fields as $fields){
                    FormDataResult::create([
                        'institute_id' => $request->institute,
                        'student_id' => $user->id,
                        'answers' => $fields,
    
                    ]);
                }
            }
            
          
           
            $name=$request->fullname;
          
            // Mail::to($request->email)->send(new UserRegistrationMail($name));
            // Commit And Redirected To Listing
            DB::commit();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' =>  $user->user_id,
                'description' => 'Student Added',

            ]);
            return redirect()->route('student.view',$user->user_id)->with('success', 'Applied Successfully');
            // if(auth()->user()->role_id==1){
               
            // }else{
            //     return redirect()->back()->with('success', 'Student has been Added Successfully.');
            // }
            
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function delete($id)
    {
      
        DB::beginTransaction();
        try {
            $student = Student::where('id', $id)->first();

            // Delete the institute
            $student->delete();

            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' =>  null,
                'description' => 'Student Deleted',
        


            ]);
           
            DB::commit();
            return redirect()->route('student.index')->with('success', 'Student has been Deleted Successfully.');
        } catch (\Throwable $th) {
           
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function view($id)
    {
        $student = Student::where('user_id', $id)->first();
        if($student){
            $additional_form=FormData::where('institute_id',$student->institute_id)->get();
            $additional_form_result=FormDataResult::where('institute_id',$student->institute_id)->where('student_id',$student->id)->get();
            $count=count($additional_form);
        }else{
            $additional_form='';
            $additional_form_result='';
            $count='';
        }

        return view('student.view', compact('student','count','additional_form','additional_form_result'));
    }
    public function edit($id)
    {
        $student = Student::where('id', $id)->first();
        return view('student.edit', compact('student'));
    }
    public function update_user(Request $request)
    {

        $request->validate([
            'fullname' => 'required',
            'dob' => 'required',
            'nationality' => 'required',
            'fathername' => 'required',
            'mothername' => 'required',
            'address' => 'required',
            'city' => 'required',
            'district' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable',
            'islamicstudy' => 'required',
            'secularstudy' => 'required',
            'islamicyear' => 'required',
            'secularyear' => 'required',
        ]);
        DB::beginTransaction();
        try {
            if ($request->motheroccupation == 'other') {
                $motheroccupation = $request->otheroccupation;
            } else {
                $motheroccupation = $request->motheroccupation;
            }

           
        
            $user=Student::where('id',$request->user_id)->first();
                if ($request->hasFile('imageUpload') && $request->file('imageUpload')->isValid()) {
                    $profile = time() . '.' . $request->imageUpload->extension();
                    $request->imageUpload->move(public_path('profile'), $profile);

                    $user->profile_photo = $profile;
                }
                
                $user->name = $request->fullname;
                $user->email = $request->email;
                $user->dob = $request->dob;
                $user->nationality = $request->nationality;
                $user->religion = $request->religion;
                $user->father_name = $request->fathername;
                $user->father_occupation = $request->fatheroccupation;
                $user->mother_name = $request->mothername;
                $user->mother_occupation = $motheroccupation;
                $user->address = $request->address;
                $user->city = $request->city;
                $user->district = $request->district;
                $user->state = $request->state;
                $user->pin = $request->pincode;
                $user->mobile = $request->phone;
                
                $user->islamic_qualfication = $request->islamicstudy;
                $user->islamic_year = $request->islamicyear;
                $user->secular_qualfication = $request->secularstudy;
                $user->secular_year = $request->secularyear;
               

                Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' =>  $user->user_id,
                'description' => 'Student Profile Updated',

            ]);

                $user->save();

            
            // Commit And Redirected To Listing
             DB::commit();
             $user=Student::where('id',$request->user_id)->first();
            return redirect()->route('student.view',$user->user_id)->with('success', 'Student has been Added Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function admit_card()
    {
        return view('student.admit_card_search');
    }
    public function admit_card_result(Request $request)
    {
           if(auth()->user()->role_id==1){
                 $student = Student::where('mobile', $request->search)->orWhere('id', $request->search)->where('status',1)->first();
           }
           if(auth()->user()->role_id==2){
            $student = Student::where('mobile', $request->search)->orWhere('id', $request->search)->where('institute_id', auth()->user()->institute_id)->where('status',1)->first();
            }
            if(auth()->user()->role_id==3){
                $student = Student::where('mobile', $request->search)->orWhere('id', $request->search)->where('department_id', auth()->user()->department_id)->where('status',1)->first();
            }
            if(auth()->user()->role_id==4){
                $student = Student::where('mobile', $request->search)->orWhere('id', $request->search)->where('user_id', auth()->user()->id)->where('status',1)->first();
            }
           
            if ($student) {
                $department = $student->department;
                $lastDate = Department::where('id', $student->department_id)->pluck('last_date')->first();
            
                if ($department->payment_type == 1 && $student->free == 1) {
                    if ($lastDate >= Carbon::now()) {
                        return redirect()->back()->with('error', 'Admit Cards are Not Uploaded Yet');
                    } else {
                        $check = PaymentLog::where('user_id', $student->id)->count();
                        return view('student.admit_card', compact('check','student'));
                    }
                } else {
                    
                    $check = '1';
                    return view('student.admit_card', compact('check','student'));
                }
            } else {
                return redirect()->back()->with('error', 'Record Not Found');
            }
            
    }


    public function dowload_application($id)
    {   
        $student = Student::where('id', $id)->first();

         return view('student.pdf', compact('student'));
    }
    public function dowload_admit_card($id)
    {   
         $student = Student::where('id', $id)->first();
         return view('student.admitcard', compact('student'));
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            $student = Student::where('id', $id)->first();
           
            if($request->update==1){
               
                $student->status=1;
            }
            elseif($request->update==3){
               
                $student->status=3;
            }else{
                
                $student->status=2;
            }
            $student->save();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' =>  $student->user_id,
                'description' => 'Student Status Updated',

            ]);
            

            DB::commit();
            return redirect()->back()->with('success', 'Status has been Updated Successfully.');
        } catch (\Throwable $th) {
            
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function paid_free($id)
    {
        DB::beginTransaction();
        try {
            $student = Student::where('id', $id)->first();
            if($student->free==1){
                $student->free=0;
            }else{
                $student->free=1;
            }

            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' =>  $student->user_id,
                'description' => 'Student Payment Mode Update',

            ]);
            $student->save();

            DB::commit();
            return redirect()->back()->with('success', 'Payment Mode has been Updated Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function filter(Request $request)
    {
        if($request->post()){
            $students=Student::where('institute_id',$request->institute)->where('department_id',$request->department)->get();
            if(auth()->user()->role_id==1){
                $institutes = Institute::get();
            }else{
                $institutes = Institute::where('id',auth()->user()->institute_id)->first();
            }
           
            $filter_i= Institute::where('id',$request->institute)->first();
            $filter_d=Department::where('id',$request->department)->first();
            $method='post';
         }else{
            if(auth()->user()->role_id==1){
                $students=Student::get();
                $institutes = Institute::get();
            }
            if(auth()->user()->role_id==2){
                $students=Student::where('institute_id',auth()->user()->institute_id)->get();
                $institutes = Institute::where('id',auth()->user()->institute_id)->first();
            }
            $filter_i='';
            $filter_d='';
            $method='get';
         }
       
            return view('student.filter', compact('students','institutes','method','filter_i','filter_d'));
    }
}
