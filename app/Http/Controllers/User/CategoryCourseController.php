<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryCourseController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index($category){
        $category = \App\Models\Category::where('id', $category)->first();
        return view('user.categories.index', compact('category'));
    }
}
