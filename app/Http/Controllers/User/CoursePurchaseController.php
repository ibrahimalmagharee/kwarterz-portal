<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;

class CoursePurchaseController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index(){
        $courses = Purchase::where('user_id', \Auth::user()->id)->where('approved_payment', '!=', null)->get();
        return view('user.course-purchase.index', compact('courses'));
    }

    public function show($course_id){
        $purchased = Purchase::where('course_id', $course_id)->where('user_id', \Auth::user()->id)->where('approved_payment', '!=', null)->first();
        if($purchased){
            return view('user.course-purchase.show', compact('purchased'));
        }
        return back();
    }
}

