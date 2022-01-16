@extends('layouts.admin')

@section('content')

<div class="blog-single gray-bg">

        <div class="">
        <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 ">
          <h3 class="content-header-title"></h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">الرئيسية</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('course.index')}}">الدورات</a>
                </li>
                <li class="breadcrumb-item active">عرض
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">

          </div>
        </div>
      </div>
            <div class="row align-items-start">
                <div class="col-lg-12 m-15px-tb">
                    <article class="article">
                    <img src="{{$course->image_path}}" alt="{{$course->title}}" width="35%" style="margin : 0 30%">

                        <div class="article-title">
                            <h6><a href="#">الاسم</a></h6>
                            <h2>{{$course->title}}</h2>
                        </div>
                        <div class="article-content">
                        <div class="article-title">
                            <h6><a href="#">الوصف</a></h6>
                        </div>
                        {!! $course->description !!}

                        </div>
                        @if ($course->benefit)
                            <div class="article-content">
                                <div class="article-title">
                                    <h6><a href="#">فائدة الدورة</a></h6>
                                </div>
                                {!! $course->benefit !!}
                            </div>
                        @endif

                        <div class="article-title">
                            <h6><a href="#">عدد الساعات</a></h6>
                            <h2>{{$course->hours}}</h2>
                        </div>
                        <div class="article-title">
                            <h6><a href="#">عدد الساعات</a></h6>
                            <h2>{{$course->price}}</h2>
                        </div>
                    </article>

                </div>

            </div>
        </div>
    </div>
@endsection


