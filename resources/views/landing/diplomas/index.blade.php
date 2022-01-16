@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="section-activities">
            <div class="blog-page  bg-white">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="page-title style1 col-xl-6 col-lg-8 col-md-10 text-center mb-5">
                            <h2 class="text-grey-900 fw-700 font-xxl pb-3 mb-0 mt-3 d-block lh-3">جميع الدبلومات</h2>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($diplomas as $diploma)
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                                <article class="post-article p-0 border-0 shadow-xss rounded-lg overflow-hidden aos-init" data-aos="zoom-in" data-aos-delay="600" data-aos-duration="500" data-aos-once="true">
                                    <a href="{{route('show.diploma', $diploma->slug)}}"><img src="{{asset('/public/uploads/diplomas/'. $diploma->images[0]->name)}}" alt="blog-image" class="w-100"></a>
                                    <div class="post-content p-4">
                                        <h6 class="font-xsss text-success fw-600 float-left"><a href="" class="lh-30 font-sm mont-font text-grey-800 fw-700">{{$diploma->title}}</a></h6>
                                        <h6 class="font-xssss text-grey-500 fw-600 mr-3 float-right"><i class="ti-time mr-2"></i> {{ \Carbon\Carbon::parse($diploma->created_at)->format('d/m/Y') }}</h6>
                                        <div class="clearfix"></div>
                                        <a href="{{route('show.diploma', $diploma->slug)}}" class="rounded-xl text-white bg-current w125 p-2 lh-32 font-xsss text-center fw-500 d-inline-block mb-0 mt-2">اقرأ المزيد</a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $diplomas->links() }}
            </div>
        </div>
        @include('landing.footer')
    </div>
@endsection
