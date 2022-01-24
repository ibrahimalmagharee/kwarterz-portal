<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Image;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request){
        $news= News::paginate(10);

        if ($request->ajax()) {

            return DataTables::of(News::query())
                //->addIndexColumn()
                ->addColumn('image', function ($new) {
                    return '<img src="'. $new->image_path .'" border="0" style="width: 140px; height: 130;" class="img-rounded" align="center" />';
                })
                ->addColumn('show', function ($new) {
                   return '<a href="/kwarterz-portal/admin/news/'.$new->slug.'" data-id="' . $new->slug . '" class="dropdown-item"><i class="ft-eye"></i> التفاصيل</a>';

                })
                ->editColumn('user_id', function ($new) {
                    return $new->user->name;
                 })
                ->addColumn('actions', function ($new) {
                    $classSlider = 'makeSlider';
                    $textSlider = 'اضافة للسلايدر';
                    if(!is_null($new->slider)){
                        $classSlider = 'removeSlider';
                        $textSlider = 'حذف من  السلايدر';
                    }
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/kwarterz-portal/admin/news/'.$new->slug.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $new->id . '" class="dropdown-item '.$classSlider.'"><i class="ft-plus-2"></i>'.$textSlider.'</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions','image','show','user_ud'])
                ->make(true);


        }
        return view('admin.news.index',compact('news'));
    }
    public function store(Request $request)
    {
        $rules =News::$rules;
        $rules += ['image' => 'required|mimes:jpeg,jpg,png|max:10000'];

        $request->validate($rules,News::$messages);
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
        $new = News::create($data);
        $string_name = RandomStringController::generateRandomString();
        $imageName = time() . '.' . $string_name;
        $request->image->move(public_path('/uploads/image_news'), $imageName);
        $image = Image::create([
            'name' => $imageName
        ]);
        $new->image()->save($image);
        DB::commit();
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function show(News $new){
        return view('admin.news.show',compact('new'));
    }
    public function edit(News $new){
        return view('admin.news.create',compact('new'));
    }
    public function create(){
        return view('admin.news.create');
    }
    public function update(Request $request,News $new)
    {
        $rules = [
            'title'=> ['required',Rule::unique('news')->ignore($new->id),],
            'content'=> 'required',
        ];

        $request->validate($rules,News::$messages);
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
        DB::beginTransaction();
        if ($request->image) {
                Storage::disk('public_uploads')->delete('/image_news/'.$new->image->name);
                $new->image->delete();
                $string_name = RandomStringController::generateRandomString();
                $imageName = time() . '.' . $string_name;
                $request->image->move(public_path('/uploads/image_news'), $imageName);
                $image = Image::create([
                    'name' => $imageName
                ]);
                $new->image()->save($image);
        }
        $new->update($data);
        DB::commit();


        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('news.index')->with($notification);
    }
    public function destroy(News $new){
        $new->image->delete();
        $new->slider->delete();
        $new->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الخبر بنجاح'
        ]);
    }
    public function makeSlider(Request $request){
        $new = News::findOrFail($request->id);
        $slider = Slider::create([]);
        $new->slider()->save($slider);

        return response()->json([
            'status' => true,
            'msg' => 'تمت الاضافة للسلايدر بنجاح'
        ]);
    }
    public function removeSlider(Request $request){
        $new = News::findOrFail($request->id);
        $new->slider->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
