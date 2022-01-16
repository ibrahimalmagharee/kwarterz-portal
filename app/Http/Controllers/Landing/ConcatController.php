<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConcatController extends Controller{
    public function store(Request $request){

        if(trim($request->name == '')){
            return redirect()->back()->withErrors(['message'=>'يجب عليك كتابة اسمك']);
        }

        if(trim($request->email == '')){
            return redirect()->back()->withErrors(['message'=>'يجب عليك كتابة البريد الالكتروني الخاص بك']);
        }

        if(trim($request->message == '')){
            return redirect()->back()->withErrors(['message'=>'يجب عليك كتابة رسالتك']);
        }

        $contact = new \App\Models\Concat;
        $contact->name = trim($request->name);
        $contact->email = trim($request->email);
        $contact->message = trim($request->message);
        $contact->save();

        return redirect()->back()->withSuccess('تم ارسال الرسالة بنجاح، شكرا لتواصلك معنا');
    }
}
