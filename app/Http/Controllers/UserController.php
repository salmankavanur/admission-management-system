<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Models\Department;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        // $this->middleware('permission:user-create', ['only' => ['create','store', 'updateStatus']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }


    /**
     * List User
     * @param Nill
     * @return Array $user

     */
    public function index()
    {
        if(auth()->user()->role_id==1){
            $users = User::where('role_id','!=','4')->with('roles')->get();
            foreach($users as $key=>$user){
                $users[$key]['institute_name']=Institute::where('id',$user->institute_id)->pluck('name')->first();
            }
            $roles = Role::where('name', '!=', 'Super Admin')->where('name', '!=', 'Staff')->get();
            $institutes=Institute::get();
            $departments=Department::get();
        }
        if(auth()->user()->role_id==2){
            $users = User::where('role_id','!=','4')->where('id','!=',auth()->user()->id)->where('institute_id',auth()->user()->institute_id)->with('roles')->get();
           
             foreach($users as $key=>$user){
                $users[$key]['institute_name']=Institute::where('id',$user->institute_id)->pluck('name')->first();
                $users[$key]['department_name']=Department::where('id',$user->department_id)->pluck('name')->first();
            }
           
            $roles = Role::where('name', '!=', 'Super Admin')->where('name', '!=', 'Manager')->get();
            $institutes=Institute::where('id',auth()->user()->institute_id)->get();
            $departments=Department::where('institute_id',auth()->user()->institute_id)->get();
        }
        if(auth()->user()->role_id==3){
            $users = User::where('role_id','3')->where('id','!=',auth()->user()->id)->where('institute_id',auth()->user()->institute_id)->with('roles')->get();
            foreach($users as $key=>$user){
                $users[$key]['institute_name']=Institute::where('id',$user->institute_id)->pluck('name')->first();
            }
            $roles = Role::where('name', '!=', 'Super Admin')->get();
            $institutes=Institute::where('id',auth()->user()->institute_id)->get();
            $departments=Department::get();
        }
        if(auth()->user()->role_id==4){
            $users = User::where('role_id','3')->where('id','!=',auth()->user()->id)->where('institute_id',auth()->user()->institute_id)->with('roles')->get();
            foreach($users as $key=>$user){
                $users[$key]['institute_name']=Institute::where('id',$user->institute_id)->pluck('name')->first();
            }
            $roles = Role::where('name', '!=', 'Super Admin')->get();
            $institutes=Institute::where('id',auth()->user()->institute_id)->get();
            $departments=Department::get();
        }
       

        return view('users.index', ['users' => $users,'roles' => $roles,'institutes' => $institutes,'departments' => $departments]);
    }

    /**
     * Create User
     * @param Nill
     * @return Array $user

     */
    public function create()
    {
        $roles = Role::all();
        $institutes=Institute::get();

        return view('users.add', ['roles' => $roles,'institutes' => $institutes]);
    }
    public function update_department(Request $request)
    {
        $update=User::where('id',auth()->user()->id)->first();
        $update->department_id=$request->department;
        $update->save();

        return redirect()->back()->with('success','Success');
    }

    /**
     * Store User
     * @param Request $request
     * @return View Users

     */
    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'name'    => 'required',
            'email'         => 'required|unique:users,email',
            // 'password' => 'required|numeric|digits:10',
            'institute' =>'required',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $user = User::create([
                'name'    => $request->name,
                'email'         => $request->email,
                'mobile_number' => $request->contact,
                'role_id'       => $request->role,
                'status'        => 1,
                'password'      => Hash::make('password@1234'),
                'institute_id'      => $request->institute,
                'department_id'      => $request->department,
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();

            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.index')->with('success','User Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Update Status Of User
     * @param Integer $status
     * @return List Page With Success

     */
    public function updateStatus($user_id)
    {
        
        try {
            DB::beginTransaction();

            // Update Status
            $user=User::whereId($user_id)->first();
            if($user->status==1){
                $user->status=0;
            }else{
                $user->status=1;
            }
            $user->save();
            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('users.index')->with('success','User Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Edit User
     * @param Integer $user
     * @return Collection $user

     */
    public function edit($user)
    {
        $roles = Role::all();
        $user = User::where('id',$user)->first();
        return view('users.edit')->with([
            'roles' => $roles,
            'user'  => $user
        ]);
    }

    /**
     * Update User
     * @param Request $request, User $user
     * @return View Users

     */
    public function update(Request $request,$user)
    {
        // Validations
        $request->validate([
            'fullname'    => 'required',
            'email'         => 'required|unique:users,email,'.$user.',id',
            'phone' => 'required|numeric',
            'imageUpload' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        DB::beginTransaction();
        try {

           
            // Store Data
            $user_updated = User::whereId($user)->update([
                'name'          => $request->fullname,
                'email'         => $request->email,
                'mobile_number' => $request->phone,
            ]);
            if ($request->hasFile('imageUpload') && $request->file('imageUpload')->isValid()) {
                $dp = time() . '.' . $request->imageUpload->extension();
                $request->imageUpload->move(public_path('dp'), $dp);

                $user_dp = User::whereId($user)->update([
                    'dp'          => $dp,
                ]);
            }
            if ($request->pw) {
                $user_pw = User::whereId($user)->update([
                    'password'          => Hash::make($request->pw),
                ]);
            }

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.edit',$user)->with('success','User Updated Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Delete User
     * @param User $user
     * @return Index Users

     */
    public function delete($user)
    {
        ;
        DB::beginTransaction();
        try {
            // Delete User
            User::whereId($user)->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Student Deleted Successfully!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
