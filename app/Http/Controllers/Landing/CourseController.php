<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller{

    public function index(){
        $courses = \App\Models\Course::paginate(18);
        $categories = \App\Models\Category::where('type', 'course')->get();
        $links = \App\Models\Social::all();
        return view('landing.course.index', compact(['courses', 'categories', 'links']));
    }

    public function show($course){
        $course = \App\Models\Course::where('id', $course)->orWhere('slug', $course)->first();
        $links = \App\Models\Social::all();
        return view('landing.course.show', compact(['course', 'links']));
    }
}
