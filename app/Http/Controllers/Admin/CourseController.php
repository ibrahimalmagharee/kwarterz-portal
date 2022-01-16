<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Lecture;
use App\Models\Purchase;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request){
        $courses= Course::paginate(10);

        if ($request->ajax()) {

            return DataTables::of(Course::query())
                //->addIndexColumn()
                ->addColumn('sections', function ($course) {
                    return '<a href="/admin/course/'.$course->slug.'/section" data-id="' . $course->slug . '" class="dropdown-item showNew"><i class="ft-eye"></i> عرض</a>';;
                })
                ->editColumn('user_id', function ($new) {
                    return $new->user->name;
                 })
                ->editColumn('category_id', function ($course) {
                    return $course->category->name;
                })
                ->addColumn('lessons', function ($course) {
                    return '<a href="/admin/course/'.$course->slug.'/lesson" data-id="' . $course->slug . '" class="dropdown-item showNew"><i class="ft-eye"></i> عرض</a>';;
                }) ->addColumn('show', function ($course) {
                    return '<a href="/admin/course/'.$course->slug.'" data-id="' . $course->slug . '" class="dropdown-item"><i class="ft-eye"></i> التفاصيل</a>';

                 })
                ->addColumn('actions', function ($course) {
                    $classSlider = 'makeSlider';
                    $textSlider = 'اضافة للسلايدر';
                    if(!is_null($course->slider)){
                        $classSlider = 'removeSlider';
                        $textSlider = 'حذف من  السلايدر';
                    }
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/admin/course/'.$course->slug.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $course->slug . '" class="dropdown-item deleteCourse"><i class="ft-trash-2"></i> حذف</a>
                        <a href="javascript:void(0)" data-id="' . $course->id . '" class="dropdown-item '.$classSlider.'"><i class="ft-plus-2"></i>'.$textSlider.'</a>

                        </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions','sections','lessons','show','category_id'])
                ->make(true);


        }
        return view('admin.course.index',compact('courses'));
    }
    public function store(Request $request)
    {
        $rules =Course::$rules;
        $rules += ['image' => 'required|mimes:jpeg,jpg,png|max:10000'];
        $request->validate( $rules,Course::$messages);
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
        $data = $request->all();
        $data['slug'] = $string;
        $data['user_id'] = Auth::user()->id;
        $course = Course::create($data);
        $string_name = RandomStringController::generateRandomString();
        $imageName = time() . '.' . $string_name;
        $request->image->move(public_path('/uploads/image_course'), $imageName);
        $image = Image::create([
            'name' => $imageName
        ]);
        $course->image()->save($image);


        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function show(Course $course){
        return view('admin.course.show',compact('course'));
    }
    public function edit(Course $course){
        $categories = Category::where('type','course')->get();
        return view('admin.course.create',compact('course','categories'));
    }
    public function create(){
        $categories = Category::where('type','course')->get();
        return view('admin.course.create',compact('categories'));
    }
    public function course_sales(Request $request){
        $project_ids =  Purchase::where('approved_payment','!=',null)->where('refund_payment','=',null)->pluck('course_id')->toArray();
        $courses = Course::whereIn('id',$project_ids)->get();
        if ($request->ajax()) {
            $project_ids =  Purchase::where('approved_payment','!=',null)->where('refund_payment','=',null)->pluck('course_id')->toArray();
             return DataTables::of(Course::whereIn('id',$project_ids)->get())
                 ->addColumn('count_sales',function($course){
                     return Purchase::where('course_id',$course->id)->where('approved_payment','!=',null)->where('refund_payment','=',null)->count();
                 })
                  ->rawColumns(['count_sales'])
                 ->make(true);


         }
        return view('admin.course.sales',compact('courses'));
    }

    public function update(Request $request,Course $course)
    {
        $request->validate(Course::$rules,Course::$messages);
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
        $data = $request->all();
        $data['slug'] = $string;
        $course->update($data);
        if ($request->image) {
            Storage::disk('public_uploads')->delete('/image_course/'.$course->image->name);
            $course->image->delete();
            $string_name = RandomStringController::generateRandomString();
            $imageName = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/image_course'), $imageName);
            $image = Image::create([
                'name' => $imageName
            ]);
            $course->image()->save($image);
    }


        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('course.index')->with($notification);
    }
    public function destroy(Course $course){
        $sectionIds= $course->sections()->pluck('id')->toArray();
        $lessons = Lecture::whereIn('id',$sectionIds)->get();
        foreach( $lessons as $lec){
            Storage::disk('public_uploads')->delete('courses/'.$course->title.'/section/'.$lec->section->name.'/'.$lec->lecture);
            $lec->delete();
        }
        $course->sections()->delete();
        $course->slider->delete();
        $course->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الدورة بنجاح'
        ]);
    }
    public function makeSlider(Request $request){
        $course = Course::findOrFail($request->id);
        $slider = Slider::create([]);
        $course->slider()->save($slider);

        return response()->json([
            'status' => true,
            'msg' => 'تمت الاضافة للسلايدر بنجاح'
        ]);
    }
    public function removeSlider(Request $request){
        $course = Course::findOrFail($request->id);
        $course->slider->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}

