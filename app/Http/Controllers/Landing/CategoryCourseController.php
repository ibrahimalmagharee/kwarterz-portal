<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryCourseController extends Controller{

    public function index($category){
        $category = \App\Models\Category::where('id', $category)->first();
        $links = \App\Models\Social::all();
        return view('landing.categories.index', compact(['category', 'links']));
    }
}
