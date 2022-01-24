<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request){
        $activities= Activity::orderBy('created_at','desc')->paginate(10);

        if ($request->ajax()) {

            return DataTables::of(Activity::query())
                ->editColumn('category_id', function ($activity) {
                    return $activity->category->name;
                })
                ->addColumn('show', function ($activity) {
                    return '<a href="/kwarterz-portal/admin/activity/'.$activity->slug.'" data-id="' . $activity->id . '" class="dropdown-item"><i class="ft-eye"></i> التفاصيل</a>';;
                })->editColumn('user_id', function ($activity) {
                    return $activity->user->name;
                 })
                ->addColumn('image', function ($activity) {
                    return '<img src="'. $activity->image_path .'" border="0" style="width: 140px; height: 130;" class="img-rounded" align="center" />';
                })
                ->addColumn('actions', function ($activity) {
                    $classSlider = 'makeSlider';
                    $textSlider = 'اضافة للسلايدر';
                    if(!is_null($activity->slider)){
                        $classSlider = 'removeSlider';
                        $textSlider = 'حذف من  السلايدر';
                    }
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/kwarterz-portal/admin/activity/'.$activity->slug.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $activity->slug . '" class="dropdown-item deleteActivity"><i class="ft-trash-2"></i> حذف</a>
                        <a href="javascript:void(0)" data-id="' . $activity->id . '" class="dropdown-item '.$classSlider.'"><i class="ft-plus-2"></i>'.$textSlider.'</a>

                        </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions','image','show'])
                ->make(true);


        }
        return view('admin.activities.index',compact('activities'));
    }
    public function store(Request $request)
    {
        $rules =Activity::$rules;
        $rules += ['image' => 'required|mimes:jpeg,jpg,png|max:10000'];

        $request->validate($rules,Activity::$messages);
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
        DB::beginTransaction();
        $activity = Activity::create($data);
        $string_name = RandomStringController::generateRandomString();
        $imageName = time() . '.' . $string_name;
        $request->image->move(public_path('/uploads/image_activity'), $imageName);
        $image = Image::create([
            'name' => $imageName
        ]);
        $activity->image()->save($image);
        DB::commit();
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function show(Activity $activity){
        return view('admin.activities.show',compact('activity'));
    }
    public function edit(Activity $activity){
        $categories = Category::where('type','activity')->get();
        return view('admin.activities.create',compact('activity','categories'));
    }
    public function create(){
        $categories = Category::where('type','activity')->get();
        return view('admin.activities.create',compact('categories'));
    }
    public function update(Request $request,Activity $activity)
    {
        $request->validate(Activity::$rules,Activity::$messages);
        DB::beginTransaction();
        if ($request->image) {
                Storage::disk('public_uploads')->delete('/image_activity/'.$activity->image->name);
                $activity->image->delete();
                $string_name = RandomStringController::generateRandomString();
                $imageName = time() . '.' . $string_name;
                $request->image->move(public_path('/uploads/image_activity'), $imageName);
                $image = Image::create([
                    'name' => $imageName
                ]);
                $activity->image()->save($image);
        }
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
        $activity->update($data);
        DB::commit();


        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('activity.index')->with($notification);
    }
    public function destroy(Activity $activity){
        $activity->image->delete();
     //   $activity->slider->delete();
        $activity->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف النشاط بنجاح'
        ]);
    }
    public function makeSlider(Request $request){
        $activity = Activity::findOrFail($request->id);
        $slider = Slider::create([]);
        $activity->slider()->save($slider);

        return response()->json([
            'status' => true,
            'msg' => 'تمت الاضافة للسلايدر بنجاح'
        ]);
    }
    public function removeSlider(Request $request){
        $activity = Activity::findOrFail($request->id);
        $activity->slider->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
