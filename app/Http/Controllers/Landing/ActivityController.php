<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller{

    public function index(){
        $activities = \App\Models\Activity::paginate(18);
        $links = \App\Models\Social::all();
        return view('landing.activity.index', compact(['activities', 'links']));
    }

    public function show($activity){
        $activity = \App\Models\Activity::where('id', $activity)->orWhere('slug', $activity)->first();
        $links = \App\Models\Social::all();
        return view('landing.activity.show', compact(['activity', 'links']));
    }
}
