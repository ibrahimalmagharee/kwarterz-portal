<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    public $is_activity = false;
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('is_admin');


    }
    public function index(Request $request){
        $this->is_activity = $request->route()->named('category.activity*');
        if($this->is_activity){
            $categories= Category::where('type','activity')->paginate(10);
        }else{
            $categories= Category::where('type','course')->paginate(10);
        }

        if ($request->ajax()) {

            return DataTables::of(Category::where('type',$this->is_activity?'activity':'course'))
            ->editColumn('user_id', function ($new) {
                return $new->user->name;
             })
                ->addColumn('actions', function ($category) {
                   $type =  $this->is_activity?'activity':'course';
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/admin/category/'.$type.'/'.$category->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $category->id . '" class="dropdown-item deleteCategory"><i class="ft-trash-2"></i> حذف</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                }) ->addColumn('image', function ($category) {
                    return '<img src="'. $category->image_path .'" border="0" style="width: 140px; height: 130;" class="img-rounded" align="center" />';
                })
                 ->rawColumns(['actions','image'])
                ->make(true);


        }
        if($this->is_activity){
            $view = 'admin.category.activity.index';
        }else{
            $view = 'admin.category.course.index';
        }
        return view($view,compact('categories'));
    }
    public function create(Request $request){
        $this->is_activity = $request->route()->named('category.activity*');
        if($this->is_activity){
            $view = 'admin.category.activity.create';
        }else{
            $view = 'admin.category.course.create';
        }
        return view($view);
    }
    public function store(Request $request)
    {
        $this->is_activity = $request->route()->named('category.activity*');
        $rules =Category::$rules;
        if(!$this->is_activity){
          $rules += ['image' => 'required|mimes:jpeg,jpg,png|max:10000'];
        }
        DB::beginTransaction();
        $request->validate($rules,Category::$messages);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $category = Category::create($data);
        if(!$this->is_activity){
            $string_name = RandomStringController::generateRandomString();
            $imageName = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/image_category'), $imageName);
            $image = Image::create([
                'name' => $imageName
            ]);
            $category->image()->save($image);
        }

        DB::commit();
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit(Request $request, Category $category){
        $this->is_activity = $request->route()->named('category.activity*');
        if($this->is_activity){
            $view = 'admin.category.activity.create';
        }else{
            $view = 'admin.category.course.create';
        }
        return view($view,compact('category'));
    }
    public function update(Request $request,Category $category)
    {
        $this->is_activity = $request->route()->named('category.activity*');
        $request->validate(Category::$rules,Category::$messages);
        DB::beginTransaction();
        if(!$this->is_activity){
            if ($request->image) {
                Storage::disk('public_uploads')->delete('/image_category/'.$category->image->name);
                $category->image->delete();
                $string_name = RandomStringController::generateRandomString();
                $imageName = time() . '.' . $string_name;
                $request->image->move(public_path('/uploads/image_category'), $imageName);
                $image = Image::create([
                    'name' => $imageName
                ]);
                $category->image()->save($image);
        }
        }

        $category->update($request->all());
        DB::commit();

        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        if($this->is_activity){
            $route = 'category.activity.index';
        }else{
            $route = 'category.course.index';
        }
        return redirect()->route($route)->with($notification);
    }
    public function destroy(Category $category){
        $category->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الصنف بنجاح'
        ]);
    }
}
