<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function store(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirm' => ['required', 'string', 'min:6']
        ];

        $messages = [
            'name.required'=>'الاسم مطلوب',
            'email.required'=>'البريد الالكتروني مطلوب',
            'password.required'=>'كلمة المرور مطلوبة',
            'password_confirm.required'=>'تأكيد كملة المرور مطلوب',
        ];

        $request->validate($rules,$messages);

        if($request->password != $request->password_confirm){
            return redirect()->back()->withErrors(['message'=>'كلمة المرور غير متطابقتين']);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['is_admin'] = 0;

        User::create($data);

        $notification = array(
            'message' => 'تمت التسجيل  بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('user.home')->with($notification);

        return redirect()->back()->with($notification);
    }
}
