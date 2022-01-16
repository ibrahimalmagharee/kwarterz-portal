<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Company;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request){
        $companies= Company::paginate(10);

        if ($request->ajax()) {

            return DataTables::of(Company::query())
                //->addIndexColumn()
                ->addColumn('image', function ($company) {
                    return '<img src="'. $company->image_path .'" border="0" style="width: 140px; height: 130;" class="img-rounded" align="center" />';
                }) ->editColumn('user_id', function ($new) {
                    return $new->user->name;
                 })
                ->addColumn('actions', function ($company) {
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/admin/company/'.$company->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $company->id . '" class="dropdown-item deleteCompany"><i class="ft-trash-2"></i> حذف</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions','image'])
                ->make(true);


        }
        return view('admin.company.index',compact('companies'));
    }
    public function store(Request $request)
    {
        $rules = ['image' => 'required|mimes:jpeg,jpg,png|max:10000'];
        $messages =[ 'image.required'=>'الصورة مطلوبة'];

        $request->validate($rules,$messages);

        DB::beginTransaction();
        $company = Company::create([
            'user_id' =>Auth::user()->id
        ]);
        $string_name = RandomStringController::generateRandomString();
        $imageName = time() . '.' . $string_name;
        $request->image->move(public_path('/uploads/image_company'), $imageName);
        $image = Image::create([
            'name' => $imageName
        ]);
        $company->image()->save($image);
        DB::commit();
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function edit(Company $company){
        return view('admin.company.create',compact('company'));
    }
    public function create(){
        return view('admin.company.create');
    }
    public function update(Request $request,Company $company)
    {
        DB::beginTransaction();
        if ($request->image) {
                Storage::disk('public_uploads')->delete('/image_company/'.$company->image->name);
                $company->image->delete();
                $string_name = RandomStringController::generateRandomString();
                $imageName = time() . '.' . $string_name;
                $request->image->move(public_path('/uploads/image_company'), $imageName);
                $image = Image::create([
                    'name' => $imageName
                ]);
                $company->image()->save($image);
        }
        DB::commit();


        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('company.index')->with($notification);
    }
    public function destroy(Company $company){
        $company->image->delete();
        $company->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الشركة بنجاح'
        ]);
    }
}
