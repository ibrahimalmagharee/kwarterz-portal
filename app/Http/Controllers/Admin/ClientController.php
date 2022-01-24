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
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request){
        $clients= User::where('is_admin',0)->get();
        if ($request->ajax()) {

            return DataTables::of(User::where('is_admin',0)->get())
            ->editColumn('user_id', function ($client) {
                return $client->user?$client->user->name:'تسجيل دخول من قبل المستخدم';
             })
                //->addIndexColumn()
                ->addColumn('actions', function ($client) {
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/kwarterz-portal/admin/client/'.$client->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $client->id . '" class="dropdown-item deleteClient"><i class="ft-trash-2"></i> حذف</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions'])
                ->make(true);


        }
        return view('admin.user.client.index',compact('clients'));
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirm' => ['required', 'string', 'min:6']
        ];
        $messages = [
            'name.required'=>'الاسم مطلوب',
            'email.required'=>'البريد الالكتروني مطلوب',
            'password.required'=>'كلمة المرور مطلوبة',
            'password_confirm.required'=>'تأكيد كملة المرور مطلوب',
        ];

        $request->validate($rules,$messages);
        if($request->password != $request->password_confirm)
        return redirect()->back()->withErrors(['message'=>'كلمة المرور غير متطابقتين']);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['is_admin'] = 0;
        $data['user_id'] = Auth::user()->id;
         User::create($data);
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function edit(User $user){
        $client = $user;
        return view('admin.user.client.create',compact('client'));
    }
    public function create(){
        return view('admin.user.client.create');
    }
    public function update(Request $request,User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ];
        $messages = [
            'name.required'=>'الاسم مطلوب',
            'email.required'=>'البريد الالكتروني مطلوب',
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
        return redirect()->route('client.index')->with($notification);
    }
    public function destroy(User $user){
        $user->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف  بنجاح'
        ]);
    }
}

