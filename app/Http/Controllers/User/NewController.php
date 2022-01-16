<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index(){
        $news = \App\Models\News::paginate(18);
        return view('user.news.index', compact('news'));
    }

    public function show($new){
        $new = \App\Models\News::where('id', $new)->orWhere('slug', $new)->first();
        return view('user.news.show', compact('new'));
    }

}
