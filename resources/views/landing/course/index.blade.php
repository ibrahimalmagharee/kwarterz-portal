@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="section-activities">
            <div class="how-to-work pb-lg--7 pt-3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="page-title style1 col-xl-6 col-lg-6 col-md-10 text-center mb-5">
                            <h2 class="text-grey-900 fw-700 display1-size display2-md-size pb-3 mb-0 d-block">جميع الدورات</h2>
                            <p class="fw-300 font-xsss lh-28 text-grey-500">الكثير من الناس يتجه الان نحو قسم التكنولوجيا لما له من مستقبل عظيم في السنوات القادمة</p>
                            {{-- <ul class="nav nav-tabs tabs-icon list-inline d-block w-100 text-center border-bottom-0 mt-4" id="myNavTabs">
                                @foreach ($categories as $category)
                                    <li class="list-inline-item"><a class="fw-700 ls-3 font-xssss text-black text-uppercase ml-3 item-category-nav" href="#navtabs{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
                                @endforeach
                            </ul> --}}
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="row">
                            @foreach ($courses as $course)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mb-4">
                                    <div class="card w-100 p-0 shadow-xss border-0 rounded-lg overflow-hidden mr-1">
                                        <div class="card-image w-100 mb-3">
                                            <a href="{{route('show.course', $course->slug)}}" class="position-relative d-block"><img src="{{$course->image_path}}" alt="image" class="  w-100"></a>
                                        </div>
                                        <div class="card-body pt-0">
                                            <span class="font-xsssss fw-700 pl-3 pr-3 lh-32 text-uppercase rounded-lg ls-2 alert-danger d-inline-block text-danger mr-1">{{$course->category->name}}</span>
                                            <span class="font-xss fw-700 pl-3 pr-3 ls-2 lh-32 d-inline-block text-success float-right"><span class="font-xsssss">دينار أردني</span> {{$course->price}}</span>
                                            <h4 class="fw-700 font-xss mt-3 lh-28 mt-0"><a href="{{route('show.course', $course->slug)}}" class="text-dark text-grey-900">{{$course->title}} </a></h4>
                                            <h6 class="font-xssss text-grey-500 fw-600 ml-0 mt-2"> {{$course->lessons_number()}} محاضرة </h6>
                                            <ul class="memberlist mt-3 mb-2 ml-0 d-block">
                                                <li class="last-member"><a href="{{route('show.course', $course->slug)}}" class="bg-greylight fw-600 text-grey-500 font-xssss ls-3 text-center">{{$course->students_number()}}</a></li>
                                                <li class="pr-4 w-auto"><a href="{{route('show.course', $course->slug)}}" class="fw-500 text-grey-500 font-xssss">عدد الطلاب</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{ $courses->links() }}
            </div>
        </div>
        @include('landing.footer')
    </div>
@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {
            $('.list-inline-item:first-child').addClass('active');
            $('.item-category-nav:first-child').addClass('active');

            $('.item-course:first-child').addClass('show');
            $('.item-course:first-child').addClass('active');
        });
    </script> --}}
@endsection
