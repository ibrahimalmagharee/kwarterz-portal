@extends('app')
@section('content')

    @include('user.sections.nav')

    <div class="main-content">
        @include('user.sections.topSidebar')

        <div class="blog-page pt-lg--1 pb-lg--2 pt-5 pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="page-title style1 col-xl-6 col-lg-8 col-md-10 text-center mb-5">
                        <h2 class="text-grey-900 fw-700 font-xxl pb-3 mb-0 mt-3 d-block lh-3">جميع الدورات التي قمت بشرائها</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($courses as $course)
                        <div class="col-xl-4 col-xxxl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                            <div class="card w-100 p-0 shadow-xss border-0 rounded-lg overflow-hidden mr-1">
                                <div class="card-image w-100 mb-3">
                                    <a href="{{route('user.show.purchase.course', $course->course->id)}}" class="position-relative d-block"><img src="{{$course->course->image_path}}" alt="image" class="w-100"></a>
                                </div>
                                <div class="card-body pt-0">
                                    <span class="font-xsssss fw-700 pl-3 pr-3 lh-32 text-uppercase rounded-lg ls-2 alert-warning d-inline-block text-warning mr-1">{{$course->course->category->name}}</span>
                                    <span class="font-xss fw-700 pl-3 pr-3 ls-2 lh-32 d-inline-block text-success float-right"><span class="font-xsssss mr-1 float-right">دينار أردني</span> {{$course->course->price}}</span>
                                    <h4 class="fw-700 font-xss mt-3 lh-28 mt-0"><a href="{{route('user.show.purchase.course', $course->course->id)}}" class="text-dark text-grey-900">{{$course->course->title}} </a></h4>
                                    <h6 class="font-xssss text-grey-500 fw-600 ml-0 mt-2"> {{$course->course->lessons_number()}} محاضرة </h6>
                                    <ul class="memberlist mt-3 mb-2 ml-0 d-block">
                                        <li class="last-member"><a href="#" class="bg-greylight fw-600 text-grey-500 font-xssss ls-3 text-center">{{$course->course->students_number()}}</a></li>
                                        <li class="pr-4 w-auto"><a href="#" class="fw-500 text-grey-500 font-xssss">عدد الطلاب</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if (count($courses) == 0)
                        <h3 class="text-info mr-2">لم تقم بشراء أي كورس بعد</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
