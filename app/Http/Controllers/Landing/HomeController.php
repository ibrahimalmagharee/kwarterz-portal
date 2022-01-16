<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function index(){
        $categories = \App\Models\Category::where('type', 'course')->get();
        $activities = \App\Models\Activity::latest()->take(3)->get();
        $companies = \App\Models\Company::all();
        $courses = \App\Models\Course::latest()->take(6)->get();
        $links = \App\Models\Social::all();
        $sliders = \App\Models\Slider::all();
        $main_slider= \App\Models\MainSlider::first();
        return view('landing.index', compact(['categories', 'activities', 'companies', 'courses', 'links', 'sliders', 'main_slider']));
    }

    public function contact(){
        $links = \App\Models\Social::all();
        return view('landing.contact', compact('links'));
    }

    public function register(){
        return view('landing.register');
    }

    public function login(){
        return view('landing.login');
    }
}
