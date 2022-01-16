<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function create(){
        return view('admin.profile.edit');
    }
    public function update(Request $request){
         $rules = [
            'name'=> 'required',
            'email'=> 'required',
        ];
    
         $messages = [
            'name.required'=>'الاسم مطلوب',
            'name.required'=>'البريد الالكتروني مطلوب',
        ];
        $request->validate($rules,$messages);
        $admin = User::find(auth::user()->id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password?Hash::make($request->password):$admin->password
        ]);
        $notification = array(
            'message' => 'تمت التعديل بنجاح',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
