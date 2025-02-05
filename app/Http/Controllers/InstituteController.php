<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Institute;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InstituteController extends Controller
{
    public function index(){

        $institutes = Institute::orderBy('created_at', 'desc')->get();

        return view('institutes.institute',compact('institutes'));
    }
   
    public function store(Request $request)
    {
       
        // // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'city' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $logo = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('institute/logo'), $logo);
            }

                Institute::create([
                'name' => $request->name,
                'city' => $request->city,
                'address' => $request->address,
                'contact' => $request->contact,
                'logo' => $logo,
                'status' => 0,
            ]);
           
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Institute Added',

            ]);
            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('institute.index')->with('success', 'Institute has been Added Successfully.');
        } catch (\Throwable $th) {
        
             DB::rollBack();
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function update(Request $request)
    {
       
        // // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'city' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        DB::beginTransaction();
        try {

               $udpate=Institute::where('id',$request->id)->first();
               $udpate->name=$request->name;
               $udpate->city=$request->city;
               $udpate->contact=$request->contact;
               $udpate->address=$request->address;
               if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $logo = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('institute/logo'), $logo);
                $udpate->logo = $logo;
            }
               
            $udpate->save();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Institute Updated',

            ]);
            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('institute.index')->with('success', 'Institute has been Updated Successfully.');
        } catch (\Throwable $th) {
        
             DB::rollBack();
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function delete($id)
    {
       
        DB::beginTransaction();
        try {
            $institute = Institute::where('id',$id)->first();

            // Delete the institute
            $institute->delete();
            User::where('institute_id', $id)->delete();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Institute Deleted',

            ]);
            DB::commit();
            return redirect()->route('institute.index')->with('success', 'Institute has been Deleted Successfully.');
        } catch (\Throwable $th) {
        
             DB::rollBack();
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function last_date(Request $request)
    {
        DB::beginTransaction();
        $admissionPeriod = $request->admission_period;
        if (strtotime($admissionPeriod) <= strtotime(date('Y-m-d'))) {
            return redirect()->back()->with('error', 'Admission period must be after today date');
        }
        try {
            $institute = Institute::where('id',$request->institute_id)->first();
            $institute->last_date=$request->admission_period;
            $institute->save();


            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Admission Period Date Added',

            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Admission Period Has Been Set');
        } catch (\Throwable $th) {
        
             DB::rollBack();
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function status_update($id)
    {
        DB::beginTransaction();
        try {
            $institute = Department::where('id',$id)->first();
            if($institute->status==0){
                $institute->status=1;
            }else{
                $institute->status=0;
            }
           
            $institute->save();


            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Department Status Updated For Students to Apply',

            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Department Has Been Updated');
        } catch (\Throwable $th) {
        
             DB::rollBack();
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function  verify($id)
    {
        // // Validate the incoming request data
      
        DB::beginTransaction();
        try {

               $udpate=Institute::where('id',$id)->first();
               $udpate->status=1;
               
               
            $udpate->save();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Institute Updated',

            ]);
            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('forms.create')->with('success', 'Form Has Been Selected.');
        } catch (\Throwable $th) {
        
             DB::rollBack();
            
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
