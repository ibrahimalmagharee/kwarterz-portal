<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Image;
use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request,Course $course){
        $sections= $course->sections()->paginate(10);
        if ($request->ajax()) {
            return DataTables::of($course->sections)
                //->addIndexColumn()
                ->addColumn('actions', function ($section) use ($course){
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/kwarterz-portal/admin/course/'.$course->slug.'/section/'.$section->slug.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-section_id="' . $section->slug . '"  data-course_id="' . $course->slug . '" class="dropdown-item deleteSection"><i class="ft-trash-2"></i> حذف</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions'])
                ->make(true);


        }
        return view('admin.section.index',compact('course','sections'));
    }

    public function store(Request $request,Course $course)
    {
        $request->validate(Section::$rules,Section::$messages);
        $separator = '-';
        $string = $request->name;
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
         $section = Section::create($data);
         $course->sections()->save($section);

        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit(Course $course,Section $section){
        return view('admin.section.create',compact('section','course'));
    }
    public function create(Course $course){
        return view('admin.section.create',compact('course'));
    }
    public function update(Request $request,Course $course,Section $section)
    {
        $request->validate(Section::$rules,Section::$messages);
        $separator = '-';
        $string = $request->name;
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
        $section->update($data);
        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('section.index',$course->slug)->with($notification);
    }
    public function destroy(Course $course,Section $section){
        if ($course->sections->find($section)) {
            foreach( $section->lectures as $lec){
                Storage::disk('public_uploads')->delete('courses/'.$course->title.'/section/'.$section->name.'/'.$lec->lecture);
            }
            $section->lectures()->delete();
            $section->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف القسم بنجاح'
            ]);
        }
        return response()->json([
            'status' => false,
            'msg' => 'هذا القسم غير موجود'
        ]);
    }
}


