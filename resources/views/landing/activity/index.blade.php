@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="section-activities">
            <div class="blog-page  bg-white">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="page-title style1 col-xl-6 col-lg-8 col-md-10 text-center mb-5">
                            <h2 class="text-grey-900 fw-700 font-xxl pb-3 mb-0 mt-3 d-block lh-3">جميع الأنشطة</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach ($activities as $activity)
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                                        <article class="post-article p-0 border-0 shadow-xss rounded-lg overflow-hidden">
                                            <div class="row">
                                                <div class="col-6 col-xs-12"><a href="{{route('show.activity', $activity->slug)}}"><img src="{{$activity->image_path}}" alt="blog-image" class="  w-100"></a></div>
                                                <div class="col-6 col-xs-12 pl-md--0">
                                                    <div class="post-content p-4 custom-post-content">
                                                        <h6 class="font-xsss text-success fw-600 float-left">{{$activity->category->name}}</h6>
                                                        <h6 class="font-xssss text-grey-500 fw-600 mr-3 float-right"><i class="ti-time ml-2"></i> {{ \Carbon\Carbon::parse($activity->created_at)->format('d/m/Y') }}</h6>
                                                        <div class="clearfix"></div>
                                                        <h2 class="post-title mt-2 mb-2 pl-3"><a href="#" class="lh-30 font-sm mont-font text-grey-800 fw-700">{{$activity->title}}</a></h2>
                                                        <p class="font-xssss fw-400 text-grey-500 lh-28 mt-0 mb-2 pl-3">{{ \Illuminate\Support\Str::limit($activity->subtitle, 600, $end='...') }}</p>
                                                        <a href="{{route('show.activity', $activity->slug)}}" class="rounded-xl text-white bg-current w125 p-2 lh-32 font-xsss text-center fw-500 d-inline-block mb-0 mt-2">اقرأ المزيد</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{ $activities->links() }}
            </div>
        </div>
        @include('landing.footer')
    </div>
@endsection
