<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\NotifyTemplate;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function site_logo()
    {   
        $logo=Setting::first();
        return view('site',compact('logo'));
    }
    public function logo_store(Request $request)
    {
        
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        DB::beginTransaction();
        try {
            $check = Setting::first();
            
            if ($check) {
                if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                    $logo = time() . '.' . $request->logo->extension();
                    $request->logo->move(public_path('site/logo'), $logo);
                    $check->site_logo = $logo;
                }
                $check->save();

                Logs::create([
                    'admin_id' => auth()->user()->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'Site Logo Updated',

                ]);
            } else {
                if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                    $logo = time() . '.' . $request->logo->extension();
                    $request->logo->move(public_path('site/logo'), $logo);
                }
              
                Setting::create([
                    'site_logo' => $logo,
                ]);
                Logs::create([
                    'admin_id' => auth()->user()->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'Site Logo Added',

                ]);
            }


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->back()->with('success', 'Logo has been Updated Successfully.');
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function template()
    {  

        $template=NotifyTemplate::first();
        return view('notifications.template',compact('template'));
    }
    public function template_store(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $check = NotifyTemplate::first();
            
            if ($check) {
                    $check->message = $request->message;
                    $check->save();

                Logs::create([
                    'admin_id' => auth()->user()->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'Notification Message Updated',

                ]);
            } else {
               
             
                NotifyTemplate::create([
                    'message' => $request->message,
                ]);
                Logs::create([
                    'admin_id' => auth()->user()->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'Notification Message Added',

                ]);
            }


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->back()->with('success', 'Message has been Updated Successfully.');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
