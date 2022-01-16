<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $companies = \App\Models\Company::all();
        $links = \App\Models\Social::all();
        $data = \App\Models\About::first();
        return view('landing.about', compact(['companies', 'links', 'data']));
    }
}
