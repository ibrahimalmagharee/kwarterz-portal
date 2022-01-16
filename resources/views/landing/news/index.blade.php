@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="section-activities">
            <div class="blog-page  bg-white">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="page-title style1 col-xl-6 col-lg-8 col-md-10 text-center mb-5">
                            <!-- <span class="font-xsssss fw-700 pl-3 pr-3 lh-32 text-uppercase rounded-xl ls-2 alert-warning d-inline-block text-warning mr-1">Blog</span> -->
                            <h2 class="text-grey-900 fw-700 font-xxl pb-3 mb-0 mt-3 d-block lh-3">جميع الأخبار</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($news as $new)
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                                <article class="post-article p-0 border-0 shadow-xss rounded-lg overflow-hidden aos-init" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="500" data-aos-once="true">
                                    <a href="{{route('show.new', $new->slug)}}"><img src="{{$new->image_path}}" alt="blog-image" class="w-100"></a>
                                    <div class="post-content p-4">
                                        <h6 class="font-xsss text-success fw-600 float-left"><a href="" class="lh-30 font-sm mont-font text-grey-800 fw-700">{{$new->title}}</a></h6>
                                        <h6 class="font-xssss text-grey-500 fw-600 mr-3 float-right"><i class="ti-time mr-2"></i> {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y') }}</h6>
                                        <div class="clearfix"></div>
                                        {{-- <p class="font-xsss fw-400 text-grey-500 lh-26 mt-0 mb-2 pl-3">{{ \Illuminate\Support\Str::limit($new->subtitle, 60, $end='...') }}</p> --}}
                                        <a href="{{route('show.new', $new->slug)}}" class="rounded-xl text-white bg-current w125 p-2 lh-32 font-xsss text-center fw-500 d-inline-block mb-0 mt-2">اقرأ المزيد</a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $news->links() }}
            </div>
        </div>
        @include('landing.footer')
    </div>
@endsection
