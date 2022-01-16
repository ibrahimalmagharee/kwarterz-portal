<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index(){
        $courses = \App\Models\Course::paginate(18);
        return view('user.course.index', compact('courses'));
    }

    public function show($course){
        $course = \App\Models\Course::where('id', $course)->orWhere('slug', $course)->first();
        return view('user.course.show', compact('course'));
    }

    public function purchase($course){
        $course = \App\Models\Course::where('id', $course)->orWhere('slug', $course)->first();
        return view('user.course.purchase', compact('course'));
    }
}
