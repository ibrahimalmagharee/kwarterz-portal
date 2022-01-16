<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index(){
        return view('user.settings');
    }

    public function account_information(){
        return view('user.account-information');
    }

    public function update_information(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'national' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(\Auth::user()->id)],
            'mobile_number' => ['required', 'numeric', Rule::unique('users')->ignore(\Auth::user()->id)]
        ];

        $messages = [
            'name.required'=>'يجب عليك إضافة الإسم',
            'national.required'=>'يجب عليك إضافة الجنسية',
            'email.required'=>'يجب عليك إضافة البريد الإلكتروني',
            'mobile_number.required'=>'يجب عليك إضافة رقم الجوال'
        ];

        $request->validate($rules, $messages);

        \Auth::user()->name = trim($request->name);
        \Auth::user()->national = trim($request->national);
        \Auth::user()->email = trim($request->email);
        \Auth::user()->mobile_number = trim($request->mobile_number);
        \Auth::user()->address = trim($request->address);
        \Auth::user()->save();

        return redirect()->route('user.accountInformation')->withSuccess('تم تعديل بياناتك بنجاح');
    }

    public function password(){
        return view('user.change-password');
    }

    public function change_password(Request $request){

        $rules = [
            'old_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6'],
        ];

        $messages = [
            'old_password.required'=>'يجب عليك إضافة كلمة المرور القديمة',
            'new_password.required'=>'يجب عليك إضافة كلمة المرور الجديدة',
            'confirm_password.required'=>'يجب عليك تأكيد كلمة المرور',
        ];

        $request->validate($rules, $messages);

        if($request->new_password != $request->confirm_password){
            return redirect()->back()->withErrors(['message'=>'كلمة المرور غير متطابقتين']);
        }

        $result_success =  Hash::check($request->old_password, \Auth::user()->password);
        if(!$result_success){
            return redirect()->back()->withErrors(['message'=>'كلمة المرور القديمة خاطئة']);
        }

        \Auth::user()->password = Hash::make($request->new_password);
        \Auth::user()->save();

        return redirect()->route('user.changePassword')->withSuccess('تم تعديل كلمة المرور بنجاح');
    }
}
