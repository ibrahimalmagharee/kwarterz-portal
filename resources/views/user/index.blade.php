@extends('app')
@section('content')

    @include('user.sections.nav')

    <div class="main-content">

        @include('user.sections.topSidebar')

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row">
                    <div class="col-lg-12 pt-2">
                        <h2 class="fw-400 font-lg">تصفح تصنيفات الدورات</b></h2>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <div class="owl-carousel category-card owl-theme overflow-hidden overflow-visible-xl nav-none">
                            @foreach ($categories as  $category)
                                <div class="item">
                                    <div class="card mr-1 w140 border-0 p-4 rounded-lg text-center" style="background-color: #fcf1eb;">
                                        <div class="card-body p-2 ml-1 ">
                                            <a href="{{route('user.show.categories', $category->id)}}" class="btn-round-xl bg-white"><img src="{{$category->image_path}}" alt="icon" class="p-2"></a>
                                            <h4 class="fw-600 font-xsss mt-3 mb-0">{{$category->name}} <span class="d-block font-xsssss fw-500 text-grey-500 mt-2">{{$category->courses->count()}} دورة</span></h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-12 pt-5 mb-3">
                        <h2 class="fw-400 font-lg d-block">الدورات المتداولة</h2>
                    </div>

                    <div class="col-lg-12 pt-2">
                        <div class="owl-carousel category-card owl-theme overflow-hidden overflow-visible-xl nav-none">
                            @foreach ($courses as $course)
                                <div class="item">
                                    <div class="card w300 p-0 shadow-xss border-0 rounded-lg overflow-hidden mr-1 mb-4">
                                        <div class="card-image w-100 mb-3">
                                            @if ($course->is_purchased(\Auth::user()->id))
                                                <a href="{{route('user.show.purchase.course', $course->id)}}" class="position-relative d-block"><img src="{{$course->image_path}}" alt="image" class="w-100"></a>

                                                @else
                                                <a href="{{route('user.show.course', $course->slug)}}" class="position-relative d-block"><img src="{{$course->image_path}}" alt="image" class="w-100"></a>
                                            @endif
                                        </div>
                                        <div class="card-body pt-0">
                                            <span class="font-xsssss fw-700 pl-3 pr-3 lh-32 text-uppercase rounded-lg ls-2 alert-warning d-inline-block text-warning mr-1">{{$course->category->name}}</span>
                                            <span class="font-xss fw-700 pl-3 pr-3 ls-2 lh-32 d-inline-block text-success float-right"><span class="font-xsssss mr-1 float-right">دينار أردني</span> {{$course->price}}</span>

                                            @if ($course->is_purchased(\Auth::user()->id))
                                                <h4 class="fw-700 font-xss mt-3 lh-28 mt-0"><a href="{{route('user.show.purchase.course', $course->id)}}" class="text-dark text-grey-900">{{$course->title}} </a></h4>
                                                @else
                                                <h4 class="fw-700 font-xss mt-3 lh-28 mt-0"><a href="{{route('user.show.course', $course->slug)}}" class="text-dark text-grey-900">{{$course->title}} </a></h4>
                                            @endif

                                            <h6 class="font-xssss text-grey-500 fw-600 ml-0 mt-2"> {{$course->lessons_number()}} محاضرة </h6>
                                            <ul class="memberlist mt-3 mb-2 ml-0 d-block">
                                                <li class="last-member"><a href="#" class="bg-greylight fw-600 text-grey-500 font-xssss ls-3 text-center">{{$course->students_number()}}</a></li>
                                                <li class="pr-4 w-auto"><a href="#" class="fw-500 text-grey-500 font-xssss">عدد الطلاب</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
