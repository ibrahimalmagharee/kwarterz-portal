<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveCourseController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index(){
        $courses = \Auth::user()->save_courses;
        return view('user.save-course.index', compact('courses'));
    }

    public function store(Request $request, $course_id){
        $is_found = \App\Models\SaveCourse::where('course_id', $course_id)->where('user_id', \Auth::user()->id)->count();
        if(!$is_found){
            $save_course = new \App\Models\SaveCourse;
            $save_course->course_id = $course_id;
            $save_course->user_id = \Auth::user()->id;
            $save_course->save();

            return redirect()->back()->withSuccess('تم حفظ الدورة بنجاح');
        }
    }

    public function destroy($course_id){
        $is_found = \App\Models\SaveCourse::where('course_id', $course_id)->where('user_id', \Auth::user()->id)->first();
        if($is_found){
            $is_found->delete();
            return redirect()->back()->withSuccess('تم إلغاء حفظ الدورة بنجاح');
        }
    }
}
