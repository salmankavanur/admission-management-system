<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Institute;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Logss;

class DepartmentController extends Controller
{
    public function index()
    {

        $departments = Department::orderBy('created_at', 'desc')->get();
        $institutes = Institute::get();
        return view('departments.department', compact('departments', 'institutes'));
    }
    public function store(Request $request)
    {
        
        // // Validate the incoming request data
        $request->validate([
            'institute_id' => 'required',
            'department' => 'required',
            'institute_type' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $logo = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('department/logo'), $logo);
            }

            Department::create([
                'institute_id' => $request->institute_id,
                'name' => $request->department,
                'logo' => $logo,
                'payment_type' => $request->institute_type,
                'amount' => $request->amount,
                'status' => 0,
            ]);

            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Department Added',

            ]);
            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('department.index')->with('success', 'Department has been Added Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function update(Request $request)
    {

        // // Validate the incoming request data
        $request->validate([
            'department' => 'required',
            'institute_type' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        DB::beginTransaction();
        try {

            $udpate = Department::where('id', $request->id)->first();

            $udpate->name = $request->department;
            $udpate->payment_type = $request->institute_type;
            $udpate->amount = $request->amount;
            $udpate->interview_date = $request->interview;
            $udpate->last_date = $request->last;
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $logo = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('department/logo'), $logo);
                $udpate->logo = $logo;
            }
            $udpate->save();
            // Commit And Redirected To Listing
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Department Updated',

            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Department has been Updated Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function delete($id)
    {

        DB::beginTransaction();
        try {
            $institute = Department::where('id', $id)->first();

            // Delete the institute
            $institute->delete();
            User::where('department_id', $id)->delete();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Department Deleted',

            ]);
            DB::commit();
            return redirect()->route('department.index')->with('success', 'Department has been Deleted Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function index_manager()
    {

        $departments = Department::where('institute_id',auth()->user()->institute_id)->orderBy('created_at', 'desc')->get();
        return view('departments.department_manager', compact('departments'));
    }
}
