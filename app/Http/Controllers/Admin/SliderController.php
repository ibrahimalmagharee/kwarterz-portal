<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(){
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }
    public function create(){
        return view('admin.slider.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'image'=> 'required|mimes:jpeg,jpg,png|max:10000',
            'text'=> 'required',
        ];

        $request->validate($rules);
        $string_name = RandomStringController::generateRandomString();
        $imageName = time() . '.' . $string_name;
        $request->image->move(public_path('/uploads/sliders'), $imageName);
        $slider = Slider::create([
            'image' =>  $imageName,
            'text' => $request->text
        ]);
         $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit(Request $request,Slider $slider){

        return view('admin.slider.create')->with('slider',$slider);
    }
    public function update(Request $request,Slider $slider)
    {
        $rules = [
            'image'=> 'mimes:jpeg,jpg,png|max:10000',
            'text'=> 'required',
        ];

        $request->validate($rules);
        $imageName = $slider->image;
        if ($request->image) {
            Storage::disk('public_uploads')->delete('/sliders/'.$slider->image);
            $string_name = RandomStringController::generateRandomString();
            $imageName = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/sliders'), $imageName);

    }
        $slider->update([
            'image' =>  $imageName,
            'text' => $request->text
        ]);
         $notification = array(
            'message' => 'تمت التعديل  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('slider.index')->with($notification);
    }
    public function destroy(Slider $slider){
        Storage::disk('public_uploads')->delete('/sliders/'.$slider->image);
        $slider->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف السلايدر بنجاح'
        ]);
    }
}
