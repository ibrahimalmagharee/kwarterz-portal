<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewController extends Controller{

    public function index(){
        $news = \App\Models\News::paginate(18);
        $links = \App\Models\Social::all();
        return view('landing.news.index', compact('news', 'links'));
    }

    public function show($new){
        $new = \App\Models\News::where('id', $new)->orWhere('slug', $new)->first();
        $links = \App\Models\Social::all();
        return view('landing.news.show', compact(['new', 'links']));
    }
}
