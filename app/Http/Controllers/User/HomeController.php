<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index(){
        $categories = \App\Models\Category::where('type', 'course')->get();
        $courses = \App\Models\Course::latest()->take(6)->get();

        return view('user.index', compact(['categories', 'courses']));
    }
}
