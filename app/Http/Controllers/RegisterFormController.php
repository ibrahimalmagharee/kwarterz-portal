<?php

namespace App\Http\Controllers;

use App\Models\RegisterFormInterest;
use App\Models\RegisterFormInterestUser;
use App\Models\RegistrationForm;
use Illuminate\Http\Request;

class RegisterFormController extends Controller{

    public function index(){
        $data = RegisterFormInterest::all();
        return view('landing.registerForm', compact('data'));
    }

    public function store(Request $request){

        $rules = [
            'name' => ['required'],
            'mobile_number' => ['required'],
            'employment' => ['required'],
            'country' => ['required'],
            'place_of_residence' => ['required'],
            'id_number' => ['required'],
            'nationality' => ['required'],
        ];

        $messages = [
            'name.required' => 'يجب عليك اضافة اسمك',
            'mobile_number.required' => 'يجب عليك اضافة رقم الجوال',
            'employment.required' => 'يجب عليك اضافة مجال العمل',
            'country.required' => 'يجب عليك اضافة اسم الدولة',
            'place_of_residence.required' => 'يجب عليك اضافة مكان الإقامة',
            'id_number.required' => 'يجب عليك اضافة رقم السجل المدني أو رقم الهوية',
            'nationality.required' => 'يجب عليك اضافة الجنسية',
        ];

        $request->validate($rules, $messages);

        if(!$request->interests){
            return redirect()->back()->withErrors(['message' => 'يجب عليك اختيار احدى الاهتمامات المتاحة']);
        }

        $form = RegistrationForm::create([
            'name' => trim($request->name),
            'mobile_number' => trim($request->mobile_number),
            'employment' => trim($request->employment),
            'country' => trim($request->country),
            'place_of_residence' => trim($request->place_of_residence),
            'id_number' => trim($request->id_number),
            'nationality' => trim($request->nationality),
            'code' => trim($request->code) ? trim($request->code) : null,
        ]);

        foreach($request->interests as $interest){
            RegisterFormInterestUser::create([
                'interest_id' => $interest,
                'register_form_id' => $form->id
            ]);
        }

        return redirect()->back()->withSuccess('تمت عملية الإرسال بنجاح');
    }
}
