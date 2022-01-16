<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\About;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function create(){

        $about = About::all()->first();

        return view("admin.about.about",compact('about'));
    }
    public function store(Request $request){
        $rules = [
            'text'=> 'required',

        ];
        if(count(About::all()) == 0){
            $rules += [
                'image'=> 'required|mimes:jpeg,jpg,png|max:10000'];
                $request->validate($rules);

        }



        $string_name = RandomStringController::generateRandomString();
        if(count(About::all()) == 0){
            $image = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/about'), $image);
            About::create([
                'text' => $request->text ,
                'image' => $image ,
            ]);
        }else{
            $about = About::all()->first();
           $image =  $about->image;
           if($request->image){
            $image = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/about'), $image);
           }

           $about->update([
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
