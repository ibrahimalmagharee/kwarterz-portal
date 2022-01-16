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
                <li class="breadcrumb-item"><a href="{{route('activity.index')}}">الأنشطة</a>
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
                        <div class="article-img">
                            <img src="{{$activity->image_path}}" title="" alt="">
                        </div>
                        <div class="article-title">
                            <h6><a href="#">العنوان</a></h6>
                            <h2>{{$activity->title}}</h2>
                        </div>
                        <div class="article-content">
                        {!! $activity->description !!}
                        
                        </div>
                    </article>
                
                </div>
            </div>
        </div>
    </div>
@endsection


