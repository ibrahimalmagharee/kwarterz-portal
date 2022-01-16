<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\RandomStringController;
class MainSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function create(){

        $mainSlider = MainSlider::all()->first();

        return view("admin.mainSlider.form",compact('mainSlider'));
    }
    public function store(Request $request){
        $rules = [
            'text'=> 'required',
        ];
        if(count(MainSlider::all()) == 0){
            $rules += [
                'image'=> 'required|mimes:jpeg,jpg,png|max:10000'];
                $request->validate($rules);

        }



        $string_name = RandomStringController::generateRandomString();
        if(count(MainSlider::all()) == 0){
            $image = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/main-slider'), $image);
            MainSlider::create([
                'text' => $request->text ,
                'image' => $image ,
            ]);
        }else{
            $mainSlider = MainSlider::all()->first();
           $image =  $mainSlider->image;
           if($request->image){
            $image = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/main-slider'), $image);
           }

           $mainSlider->update([
            'text' => $request->text ,
            'image' => $image ,
        ]);
        }

        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }
}
