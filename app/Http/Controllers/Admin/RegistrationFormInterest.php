<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterFormInterest;
use Illuminate\Http\Request;

class RegistrationFormInterest extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(){
        $registerFormInterest = RegisterFormInterest::all();
        return view('admin.registerFormInterest.index')->with('registerFormInterest', $registerFormInterest);
    }
    public function create(){
        return view('admin.registerFormInterest.create');
    }
    public function edit(RegisterFormInterest $registerFormInterest){
        return view('admin.registerFormInterest.edit')->with('registerFormInterest', $registerFormInterest);
    }
    public function showForms(RegisterFormInterest $registerFormInterest){
        $forms = $registerFormInterest->forms;
        return view('admin.registerFormInterest.forms')->with('forms', $forms);
    }
    public function store(Request $request){
        $request->validate(['name'=>'required'],['name.required'=>'الاسم مطلوب']);
        RegisterFormInterest::create([
            'name'=>$request->name
        ]);
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('registration.form.interest.index')->with($notification);
    }
    public function update(Request $request,RegisterFormInterest $registerFormInterest){
        $request->validate(['name'=>'required'],['name.required'=>'الاسم مطلوب']);
        $registerFormInterest->update([
            'name'=>$request->name
        ]);
        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('registration.form.interest.index')->with($notification);
    }
    public function destroy(RegisterFormInterest $registerFormInterest){
        $registerFormInterest->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف  بنجاح'
        ]);
    }
}
