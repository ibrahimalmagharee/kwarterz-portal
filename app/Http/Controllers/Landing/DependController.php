<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DependController extends Controller{

    public function index(){
        $companies = \App\Models\Company::all();
        $links = \App\Models\Social::all();
        $data = \App\Models\Dependence::first();
        return view('landing.dependence', compact(['companies', 'links', 'data']));
    }
}
