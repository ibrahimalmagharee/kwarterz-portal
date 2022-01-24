<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request){
        $admins= User::where('is_admin',1)->get();
        if ($request->ajax()) {

            return DataTables::of(User::where('is_admin',1)->get())
            ->editColumn('user_id', function ($new) {
                return $new->user->name;
             })
                //->addIndexColumn()
                ->addColumn('actions', function ($admin) {
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/kwarterz-portal/admin/'.$admin->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $admin->id . '" class="dropdown-item deleteAdmin"><i class="ft-trash-2"></i> حذف</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions'])
                ->make(true);


        }
        return view('admin.user.admin.index',compact('admins'));
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'national' => ['required', 'string'],
            'mobile_number' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirm' => ['required', 'string', 'min:6']
        ];

        $messages = [
            'name.required'=>'يجب عليك إضافة الإسم',
            'national.required'=>'يجب عليك إضافة الجنسية',
            'email.required'=>'يجب عليك إضافة البريد الإلكتروني',
            'mobile_number.required'=>'يجب عليك إضافة رقم الجوال',
            'password' => 'يجب عليك إضافة كلمة المرور',
            'password_confirm' => 'يجب عليك تأكيد كلمة المرور',
        ];

        $request->validate($rules,$messages);
        if($request->password != $request->password_confirm)
        return redirect()->back()->withErrors(['message'=>'كلمة المرور غير متطابقتين']);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['is_admin'] = 1;
        $data['user_id'] = Auth::user()->id;
         User::create($data);
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function edit(User $user){
        $admin = $user;
        return view('admin.user.admin.create',compact('admin'));
    }
    public function create(){
        return view('admin.user.admin.create');
    }
    public function update(Request $request,User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'national' => ['required', 'string'],
            'mobile_number' => ['required', 'string', 'max:10', Rule::unique('users')->ignore($user->id)],
        ];
        $messages = [
            'name.required'=>'يجب عليك إضافة الإسم',
            'national.required'=>'يجب عليك إضافة الجنسية',
            'email.required'=>'يجب عليك إضافة البريد الإلكتروني',
            'mobile_number.required'=>'يجب عليك إضافة رقم الجوال'
        ];
        if($request->password || $request->password_confirm ){
            $rules+=[
                  'password' => [ 'min:6'],
            ];
            if($request->password != $request->password_confirm){
                return redirect()->back()->withErrors(['message'=>'كلمة المرور غير متطابقتين']);
            }
        }
        $request->validate($rules,$messages);

        $data = $request->all();

        $data['password'] = $request->password?Hash::make($request->password):$user->password;
        $user->update($data);

        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.index')->with($notification);
    }
    public function destroy(User $user){
        if($user->id == auth::user()->id)
         return response()->json([
            'status' => false,
            'msg' => 'لا يمكنك حذف نفسك'
        ]);
        $user->news()->delete();
        $user->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف  بنجاح'
        ]);
    }
}

