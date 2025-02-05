<?php

namespace App\Http\Controllers;

use App\Models\brochure;
use App\Models\Department;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrochureController extends Controller
{
   public function index(){

    if(auth()->user()->role_id==1){
        $brochures=brochure::get();
        $departments=Department::get();
    }else{
        $brochures=brochure::where('institute_id',auth()->user()->institute_id)->get();
        $departments=Department::where('institute_id',auth()->user()->institute_id)->get();
    }
        return view('brochure.index',compact('brochures','departments'));
   }
   public function store(Request $request)
    {
        $count=brochure::where('department_id',$request->department)->count();
        if($count < 1){
        // // Validate the incoming request data
        $request->validate([
            
            'department' => 'required',
            'brochure' => 'required|mimes:pdf',

        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('brochure') && $request->file('brochure')->isValid()) {
                $brochure = time() . '.' . $request->brochure->extension();
                $request->brochure->move(public_path('brochure'), $brochure);
            }

            brochure::create([
                'institute_id' => auth()->user()->institute_id,
                'department_id' => $request->department,
                'file' => $brochure,
             
            ]);

            Logs::create([
                'admin_id' => auth()->user()->id,  
                'user_id' => auth()->user()->id,
                'description' => 'Brochure Added',

            ]);
            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('brochures.index')->with('success', 'Brochure has been Added Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    else{
        return redirect()->back()->with('error','This Department Already Has A Brochure.Delete Old One To Add New');
    }
    }
    public function delete($id)
    {

        DB::beginTransaction();
        try {
            $file = brochure::where('id', $id)->first();


            $file->delete();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Brochure Deleted',

            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Brochure has been Deleted Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
