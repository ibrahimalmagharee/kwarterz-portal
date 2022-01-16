<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\lessThanOrEqual;

class LectureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function index(Request $request,Course $course){
        $sectionIds= $course->sections()->pluck('id')->toArray();
        $lessons = Lecture::whereIn('section_id',$sectionIds)->paginate(10);
        if ($request->ajax()) {
            return DataTables::of(Lecture::whereIn('section_id',$sectionIds)->get())
                //->addIndexColumn()
                ->addColumn('section', function ($lesson){
                    return $lesson->section->name;
                })
                ->addColumn('show', function ($lesson) use ($course) {
                   return '<a href="/admin/course/'.$course->slug.'/lesson/'.$lesson->slug.'/show" class="dropdown-item"><i class="ft-eye"></i> التفاصيل</a>';
                })
                ->addColumn('actions', function ($lesson) use ($course){
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/admin/course/'.$course->slug.'/lesson/'.$lesson->slug.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-lesson_id="' . $lesson->slug . '"  data-course_id="' . $course->slug . '" class="dropdown-item deleteLesson"><i class="ft-trash-2"></i> حذف</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                 ->rawColumns(['actions','show'])
                ->make(true);


        }
        return view('admin.lesson.index',compact('course','lessons'));
    }

    public function store(Request $request,Course $course)
    {
        $rules = Lecture::$rules;
        $rules +=['lecture'=> 'required'];
        $request->validate($rules,Lecture::$messages);
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
        $string_name = RandomStringController::generateRandomString();
        $lessonName = time() . '.' . $string_name;
        $section = $course->sections->where('id',$request->section_id)->first();
        $request->lecture->move(public_path('/uploads/courses/'.$course->id.'/section/'.$section->id), $lessonName);
        $lecture = Lecture::create([
            'title' => $request->title,
            'description' => $request->description,
            'lecture' => $lessonName,
            'section_id' =>$request->section_id,
            'slug' => $string
        ]);

        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit(Course $course,Lecture $lecture){
        $sections = $course->sections;
        return view('admin.lesson.create',compact('lecture','course','sections'));
    }
    public function show(Course $course,Lecture $lecture){
        return view('admin.lesson.show',compact('lecture','course'));
    }
    public function create(Course $course){
        $sections = $course->sections;
        return view('admin.lesson.create',compact('course','sections'));
    }
    public function update(Request $request,Course $course,Lecture $lecture)
    {
        $create = [];
        $request->validate(Lecture::$rules,Lecture::$messages);
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
        if ($request->lecture) {
            Storage::disk('public_uploads')->delete('courses/'.$course->title.'/section/'.$lecture->section->name.'/'.$lecture->lecture);
            $string_name = RandomStringController::generateRandomString();
            $lessonName = time() . '.' . $string_name;
            $section = $course->sections->where('id',$request->section_id)->first();
            $request->lecture->move(public_path('/uploads/courses/'.$course->id.'/section/'.$section->id), $lessonName);
            $create+=['lecture' => $lessonName];

        }
        $create+=[
            'title' => $request->title,
            'description' => $request->description,
            'section_id' => $request->section_id,
            'slug' => $string
        ];
        $lecture->update($create);

        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('lesson.index',$course->slug)->with($notification);
    }
    public function destroy(Course $course,Lecture $lecture){
        $sectionIds= $course->sections()->pluck('id')->toArray();
        $lessons = Lecture::whereIn('section_id',$sectionIds)->get();
        if ($lessons->find($lecture)) {
            Storage::disk('public_uploads')->delete('courses/'.$course->title.'/section/'.$lecture->section->name.'/'.$lecture->lecture);
            $lecture->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الدرس بنجاح'
            ]);
        }
        return response()->json([
            'status' => false,
            'msg' => 'هذا الدرس غير موجود'
        ]);
    }
}
