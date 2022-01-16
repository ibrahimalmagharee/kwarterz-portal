@extends('app')
@section('content')
<div class="main-wrap">
    @include('landing.header')
    @if ($main_slider)
        <div class="banner-wrapper bg-image-cover bg-image-bottomcenter" style="background-image: url({{asset('/public/web/images/index/bg-layer.png')}});">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 vh-lg--100 align-items-center d-flex sm-mt-7">
                        <div class="card w-100 border-0 bg-transparent d-block sm-mt-7">
                            <h2 class="fw-700 text-grey-900 display4-size display4-lg-size display4-md-size lh-1 mb-0 os-init font-size40" data-aos="fade-up" data-aos-delay="300" data-aos-duration="400">كوارتز الدولية للتدريب والاعلام <i class="feather-slack text-success font-xxl"></i></h2>
                            <h4 class=" fw-500 mb-4 lh-30 font-xsss text-grey-500 mt-3 os-init" data-aos="fade-up" data-aos-delay="400" data-aos-duration="400"> {!!  $main_slider->text !!}</h4>
                            <a href="{{route('about')}}" class="btn border-0 w200 bg-primary p-3 text-white fw-600 rounded-lg d-inline-block font-xssss btn-light mt-1 os-init" data-aos="fade-up" data-aos-delay="500" data-aos-duration="400">اقرأ المزيد</a>
                        </div>
                    </div>
                    <div class="col-lg-6 align-items-center d-flex vh-lg--100 ">
                        <img src="{{$main_slider->image_path}}" alt="icon" class="pt-5 d-none d-lg-block">
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-lg-12 pl-md--2 pr-md--2 mt-sm--3 mt-5">
        <div class="banner-slider owl-carousel owl-theme owl-nav-link dot-style2 rounded-lg overflow-hidden">

            @foreach ($sliders as $slider)
                <div class="owl-items style-div bg-image-cover bg-image-center bg-no-repeat" style="background-image: url({{$slider->sliderable->image_path}});" >
                    <div class="col-lg-12 col-md-12 pt-5 pl-5 style1">
                        <h2 class="delay-03 slider-animation display3-size fw-900 display2-md-size text-white text-slider">{{$slider->sliderable->title}}</h2>
                    </div>
                </div>
            @endforeach
       </div>
    </div>

    @include('landing.sections.categories-course')

    <div class="how-to-work pb-lg--7 pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="page-title style1 col-xl-6 col-lg-6 col-md-10 text-center mb-5">
                    <h2 class="text-grey-900 fw-700 display1-size display2-md-size pb-3 mb-0 d-block">الدورات المتداولة</h2>
                    <p class="fw-300 font-xsss lh-28 text-grey-500">الكثير من الناس يتجه الان نحو قسم التكنولوجيا لما له من مستقبل عظيم في السنوات القادمة</p>
                </div>
            </div>
            <div class="tab-content">
                <div class="row">
                    @foreach ($courses as $course)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mb-4">
                            <div class="card w-100 p-0 shadow-xss border-0 rounded-lg overflow-hidden mr-1">
                                <div class="card-image w-100 mb-3">
                                    <a href="{{route('show.course', $course->slug)}}"><img src="{{$course->image_path}}" alt="image" class="  w-100"></a>
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
    </div>

    <div class="blog-page  bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="page-title style1 col-xl-6 col-lg-8 col-md-10 text-center mb-5">
                    <!-- <span class="font-xsssss fw-700 pl-3 pr-3 lh-32 text-uppercase rounded-xl ls-2 alert-warning d-inline-block text-warning mr-1">Blog</span> -->
                    <h2 class="text-grey-900 fw-700 font-xxl pb-3 mb-0 mt-3 d-block lh-3">آخر الأنشطة</h2>
                    <p class="fw-300 font-xssss lh-28 text-grey-500">من ضمن الأمور التي نقوم بها ، هي الأنشطة في المجتمع الأردني وهذه النشاطات تهدف لزيادة فكر الطالب وتأهيله للحياة التكنولوجية</p>
                </div>
            </div>
            <div class="row">
                @foreach ($activities as $activity)
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <article class="post-article p-0 border-0 shadow-xss rounded-lg overflow-hidden aos-init" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="500" data-aos-once="true">
                            <a href="{{route('show.activity', $activity->slug)}}"><img src="{{$activity->image_path}}" alt="blog-image" class="  w-100"></a>
                            <div class="post-content p-4 custom-post-content">
                                <h6 class="font-xsss text-success fw-600 float-left">{{$activity->category->name}}</h6>
                                <h6 class="font-xssss text-grey-500 fw-600 mr-3 float-right"><i class="ti-time mr-2"></i> {{ \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y') }}</h6>
                                <!-- <h6 class="font-xssss text-grey-500 fw-600 mr-3 float-left"><i class="ti-user mr-2"></i> Jack Robin</h6> -->
                                <div class="clearfix"></div>
                                <h2 class="post-title mt-2 mb-2 pl-3"><a href="{{route('show.activity', $activity->slug)}}" class="lh-30 font-sm mont-font text-grey-800 fw-700">{{$activity->title}}</a></h2>
                                <p class="font-xsss fw-400 text-grey-500 lh-26 mt-0 mb-2 pl-3">{{ \Illuminate\Support\Str::limit($activity->subtitle, 60, $end='...') }}</p>
                                <a href="{{route('show.activity', $activity->slug)}}" class="rounded-xl text-white bg-current w125 p-2 lh-32 font-xsss text-center fw-500 d-inline-block mb-0 mt-2">اقرأ المزيد</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('landing.sections.brands')

    @include('landing.footer')
</div>
@endsection
