<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Dependence;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class DependenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function create(){
        $dependence = Dependence::all()->first();
        return view("admin.dependence.dependence",compact('dependence'));
    }
    public function store(Request $request){
        $rules = [
            'text'=> 'required',
        ];
        if(count(Dependence::all()) == 0){
            $rules += ['images'=> 'required'];
        }

        $request->validate($rules);

        $images = [];
        if(count(Dependence::all()) == 0){

        //    for($i=0;$i<count($request->images);$i++){
        //     $images[$i] = $request->images[$i];
        //    }
        //     Dependence::create([
        //         'text' => $request->text ,
        //         'images' => $images ,
        //     ]);

               $dependence =  Dependence::create([
                    'text' => $request->text ,
                ]);
                for($i=0;$i<count($request->images);$i++){
                    $image =Image::create( [
                   'name' => $request->images[$i],
                   'imageable_id' =>$dependence->id,
                   'imageable_type' =>'App\Models\Dependence'
                   ]);
                   $dependence->images()->save($image);
              }
        }else{
            $dependence = Dependence::all()->first();
            $images = $dependence->images;
            if(count($images) == 0){
                $rules += ['images'=> 'required'];
            }
            $request->validate($rules);
            $count = count($images);

           if($request->images){
            // for($i=0;$i<count($request->images);$i++){
            //     $images[$i+$count] = $request->images[$i];
            //    }

            for($i=0;$i<count($request->images);$i++){
               $image =  Image::create( [
               'name' => $request->images[$i],
               'imageable_id' =>$dependence->id,
               'imageable_type' =>'App\Models\Dependence'
               ]);
               $dependence->images()->save($image);
          }

             }
           $dependence->update([
            'text' => $request->text ,
        ]);
        }

        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }
    public function uploadImageAjax(Request $request)
    {
       try {
            $string_name = RandomStringController::generateRandomString();
            $imageName =  time() .'.'.$string_name;
            $request['dzfile']->move(public_path('/uploads/dependence'), $imageName);

            return response()->json([
                'status' => true,
                'imageName' =>$imageName
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'msg' => 'فشلت عملية لبحفظ يرجى المحاولة مرة اخرى'
            ]);
        }
    }
    public function removeImageAjaxDropzone(Request $request)
    {
        $image = $request['filename'];
        $image_path = public_path('/uploads/dependence/') . $image;

         unlink($image_path);
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الصورة بنجاح'
        ]);
    }
    public function removeImageAjax(Request $request)
    {
        $image = $request['filename'];
        Dependence::all()->first()->images->where('name',$image)->first()->delete();
        $image_path = public_path('/uploads/dependence/') . $image;
        // foreach($images as $index=>$img){
        //     if($img == $image )
        //     unset($images[$index]);
        // }
        // Dependence::all()->first()->update([
        //     'images' =>$images
        // ]);


                unlink($image_path);
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الصورة بنجاح'
        ]);
    }
}
