<?php

namespace App\Http\Controllers\Admin;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Diploma;
use App\Models\Image;
use App\Models\Slider;
use Illuminate\Http\Request;

class DiplomaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
        public function index(Request $request){

            $diplomas= Diploma::paginate(10);

            if ($request->ajax()) {

                return DataTables::of(Diploma::query())

                   ->editColumn('description',function($diploma){
                       $text = \Illuminate\Support\Str::limit($diploma->description, 150, $end='...');
                       return  $text;
                   })
                    ->addColumn('actions', function ($diploma) {
                        $classSlider = 'makeSlider';
                    $textSlider = 'اضافة للسلايدر';
                    if(!is_null($diploma->slider)){
                        $classSlider = 'removeSlider';
                        $textSlider = 'حذف من  السلايدر';
                    }
                        $btn = '<td>
                        <span class="dropdown">
                          <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                          <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                            <a href="'.route('diploma.edit',$diploma->slug).'" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                            <a href="javascript:void(0)" data-id="' . $diploma->id . '" class="dropdown-item deleteDiploma"><i class="ft-trash-2"></i> حذف</a>
                            <a href="javascript:void(0)" data-id="' . $diploma->id . '" class="dropdown-item '.$classSlider.'"><i class="ft-plus-2"></i>'.$textSlider.'</a>

                            </span>
                        </span>
                      </td>';
                        return $btn;
                    })
                     ->rawColumns(['actions','show'])
                    ->make(true);


            }
            return view('admin.diploma.index',compact('diplomas'));
        }
        public function create(){
            return view('admin.diploma.create');
        }
        public function edit(Diploma $diploma){
            return view('admin.diploma.create',compact('diploma'));
        }
        public function store(Request $request)
        {
            $rules =Diploma::$rules;
            $rules += ['images' => 'required'];
            $request->validate($rules);
            $separator = '-';
            $string = $request->title;
            if (is_null($string)) {
                return "";
            }
            $string = trim($string);
            $string = mb_strtolower($string, "UTF-8");;
            $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
            $string = preg_replace("/[\s-]+/", " ", $string);
            $string = preg_replace("/[\s_]/", $separator, $string);
            $data = $request->except(['images']);
             $data['slug'] = $string;
            if($request->video){
                $string_name = RandomStringController::generateRandomString();
                $videoName = time() . '.' . $string_name;
                $request->video->move(public_path('/uploads/diplomas/video'), $videoName);
                $data['video'] = $videoName;
            }


            $diploma = Diploma::create($data);
            foreach($request->images as $key=>$value){
                $image = Image::create([
                    'name' => $value
                ]);
               $diploma->images()->save($image);
            }
            $notification = array(
                'message' => 'تمت الاضافة  بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        public function update(Request $request,$id)
        {
            $diploma = Diploma::find($id);
            $rules =Diploma::$rules;

            $request->validate($rules);
            $separator = '-';
            $string = $request->title;
            if (is_null($string)) {
                return "";
            }
            $string = trim($string);
            $string = mb_strtolower($string, "UTF-8");;
            $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
            $string = preg_replace("/[\s-]+/", " ", $string);
            $string = preg_replace("/[\s_]/", $separator, $string);
            $data = $request->except(['images']);
            $images = $diploma->images;
            if(count($images) == 0 && !$request->images)
            $rules += ['images' => 'required'];

            if($request->images){

                foreach($request->images as $key=>$value){
                    $image = Image::create([
                        'name' => $value
                    ]);
                   $diploma->images()->save($image);
                }
            }

            $data['slug'] = $string;
            if($request->video){
                $string_name = RandomStringController::generateRandomString();
                $videoName = time() . '.' . $string_name;
                $request->video->move(public_path('/uploads/diplomas/video'), $videoName);
                $data['video'] = $videoName;
            }



            $diploma->update($data);
            $notification = array(
                'message' => 'تمت التعديل  بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('diploma.index')->with($notification);
        }
        public function uploadImageAjax(Request $request)
        {
           try {
                $string_name = RandomStringController::generateRandomString();
                $imageName =  time() .'.'.$string_name;
                $request['dzfile']->move(public_path('/uploads/diplomas'), $imageName);

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
            $image_path = public_path('/uploads/diplomas/') . $image;
           return $image_path;
             unlink($image_path);
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الصورة بنجاح'
            ]);
        }
        public function removeImageAjax(Request $request)
        {
            $image = $request['filename'];

            $diploma = Diploma::findOrFail($request['id']);
            $diploma->images->where('name',$image)->first()->delete();
            $image_path = public_path('/uploads/diplomas/') . $image;




                    unlink($image_path);
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الصورة بنجاح'
            ]);
        }
        public function destroy(Request $request){
            $diploma = Diploma::find($request->id);
            foreach($diploma->images as $image){
                $image->delete();
            }
           // $diploma->slider->delete();
            $diploma->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الدبلومة بنجاح'
            ]);

        }
        public function makeSlider(Request $request){
            $diploma = Diploma::findOrFail($request->id);
            $slider = Slider::create([]);
            $diploma->slider()->save($slider);

            return response()->json([
                'status' => true,
                'msg' => 'تمت الاضافة للسلايدر بنجاح'
            ]);
        }
        public function removeSlider(Request $request){
            $diploma = Diploma::findOrFail($request->id);
            $diploma->slider->delete();

            return response()->json([
                'status' => true,
            ]);
        }
    }

