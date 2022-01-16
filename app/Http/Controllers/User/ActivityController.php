<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function index(){
        $activities = \App\Models\Activity::paginate(18);
        return view('user.activity.index', compact('activities'));
    }

    public function show($activity){
        $activity = \App\Models\Activity::where('id', $activity)->orWhere('slug', $activity)->first();
        return view('user.activity.show', compact('activity'));
    }
}
