<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Social;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request){
        $socials= Social::paginate(10);

        if ($request->ajax()) {

            return DataTables::of(Social::query())
                //->addIndexColumn()
                ->editColumn('link', function ($social) {
                    return '<a href="'.$social->link.'">'.$social->name.'</a>';
                })
                ->addColumn('actions', function ($social) {
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/kwarterz-portal/admin/social-media/'.$social->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions','image','link'])
                ->make(true);


        }
        return view('admin.social.index',compact('socials'));
    }
    public function edit(Social $social){
        return view('admin.social.create',compact('social'));
    }
    public function update(Request $request,Social $social){
        $request->validate(Social::$rules,Social::$messages);

        $social->link = $request->link;
        $social->save();
        // $social->update($request->all());

        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('social.index')->with($notification);
    }

}
