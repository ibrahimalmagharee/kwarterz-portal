<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Purchase;
use Illuminate\Http\Request;

class LessonController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index($lecture_id){
        $lecture = Lecture::where('id', $lecture_id)->first();
        if($lecture){
            $course_id = $lecture->section->course->id;
            $is_purchased = Purchase::where('course_id', $course_id)->where('user_id', \Auth::user()->id)->count();
            if($is_purchased){
                return response()->json($lecture->video_path);
            }
        }
    }
}
