<?php

namespace App\Http\Controllers;

use App\Models\AdditionalFom;
use App\Models\FormData;
use App\Models\Institute;
use App\Models\Logs;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        // $form_detail = FormData::where('institute_id',auth()->user()->institute_id)->first();
        // if($form_detail){
        //     $question = explode(',', $form_detail->question);
        //     $question_types = explode(',', $form_detail->q_type);
        //     $options = explode('-', $form_detail->option);
        //     return view('forms.form', compact('form_detail', 'question', 'question_types', 'options'));
        // }else{
        //     return view('forms.form', compact('form_detail'));
        // }
        $institute = Institute::where('id', auth()->user()->institute_id)->first();
        return view('forms.form', compact('institute'));
    }
    public function create()
    {
        $form_data = FormData::where('institute_id', auth()->user()->institute_id)->get();
        $count = count($form_data);

        $institute = Institute::where('id', auth()->user()->institute_id)->first();
        if ($institute->status == 1) {
            return view('forms.form', compact('form_data', 'count', 'institute'));
        }
        return view('forms.create', compact('form_data', 'count'));
    }

    public function save(Request $req)
    {

        try {
            $formData = $req->formData;
            $questions = explode('&', $formData);

            foreach ($questions as $question) {
                list($name, $value) = explode('=', $question);

                $decodedValue = urldecode($value);

                FormData::create([
                    'questions' => $decodedValue,
                    'institute_id' => auth()->user()->institute_id,
                ]);
            }
            $udpate = Institute::where('id', auth()->user()->institute_id,)->first();
            $udpate->status = 1;


            $udpate->save();
            Logs::create([
                'admin_id' => auth()->user()->id,
                'user_id' => auth()->user()->id,
                'description' => 'Institute Updated/Additional Form created',

            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Form data saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
