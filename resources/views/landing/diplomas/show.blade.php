@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="post-title page-nav pt-lg--7 pt-lg--7 pt-5 pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-3 mb-2"><a href="#" class="lh-2 display2-size display2-md-size mont-font text-grey-900 fw-700">{{$diploma->title}}</a></h2>
                        <h6 class="font-xssss text-grey-500 fw-600 ml-3 mt-3 d-inline-block"><i class="ti-time mr-2"></i> {{ \Carbon\Carbon::parse($diploma->created_at)->format('d/m/Y') }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="post-image">
            <div class="container">
                <div class="row">
                    @foreach ($diploma->images as $image)
                    <div class="col-lg-4 col-md-4">
                        <img src="{{asset('/public/uploads/diplomas/'. $image->name)}}" alt="blog-image" class="img-fluid rounded-lg" width="100%">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="post-content pt-lg--5 pt-lg--5 pt-3 pb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-left">
                        <p class="lh-34 fw-500 font-xsss drop-cap text-grey-600 mb-5">{!! $diploma->description !!}</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($diploma->video)
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 mb-0 rounded-lg overflow-hidden">
                            <div class="player shadow-none">
                                <video class="video-path" width="100%"  controls>
                                    <source class="video-mp4" src="{{asset('/public/uploads/diplomas/video/'. $diploma->video)}}" type="video/mp4">
                                    <source class="video-mov" src="{{asset('/public/uploads/diplomas/video/'. $diploma->video)}}" type="video/mov">
                                    <source class="video-ogg" src="{{asset('/public/uploads/diplomas/video/'. $diploma->video)}}" type="video/ogg">
                                    <source class="video-qt" src="{{asset('/public/uploads/diplomas/video/'. $diploma->video)}}" type="video/qt">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('landing.footer')
    </div>
@endsection
