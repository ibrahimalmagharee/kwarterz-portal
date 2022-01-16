<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiplomaController extends Controller{
    public function index(){
        $diplomas = \App\Models\Diploma::paginate(18);
        $links = \App\Models\Social::all();
        return view('landing.diplomas.index', compact('diplomas', 'links'));
    }

    public function show($diploma){
        $diploma = \App\Models\Diploma::where('id', $diploma)->orWhere('slug', $diploma)->first();
        $links = \App\Models\Social::all();
        return view('landing.diplomas.show', compact(['diploma', 'links']));
    }
}
