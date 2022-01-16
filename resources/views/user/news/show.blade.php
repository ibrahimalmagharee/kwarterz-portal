@extends('app')
@section('content')
    @include('user.sections.nav')
    <div class="main-content">
        @include('user.sections.topSidebar')
        <div class="post-title page-nav pt-lg--5 pt-lg--5 pt-5 pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-3 mb-2"><a href="#" class="lh-2 display2-size display2-md-size mont-font text-grey-900 fw-700">{{$new->title}}</a></h2>
                        <h6 class="font-xssss text-grey-500 fw-600 ml-3 mt-3 d-inline-block"><i class="ti-time mr-2"></i> {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y') }}</h6>
                        <!-- <h6 class="font-xssss text-grey-500 fw-600 ml-3 mt-3 d-inline-block"><i class="ti-user mr-2"></i> Jack Robin</h6> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="post-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="{{$new->image_path}}" alt="blog-image" class="img-fluid rounded-lg" width="100%">
                    </div>
                </div>
            </div>
        </div>

        <div class="post-content pt-lg--5 pt-lg--5 pt-3 pb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-left">
                        <p class="lh-34 fw-500 font-xsss drop-cap text-grey-600 mb-5">{!! $new->content !!}</p>
                        <div class="card shadow-none w-100 border-0 mb-5">

                            <ul class="mt-0 list-inline">
                                <!-- <h4 class="list-inline-item mr-5 text-grey-900 font-xs fw-700">Share this article: </h4> -->
                                <li class="list-inline-item"><a href="{{$links[0]->link}}" class="btn-round-md bg-facebook"><i class="font-xs ti-facebook text-white"></i></a></li>
                                <li class="list-inline-item"><a href="{{$links[1]->link}}" class="btn-round-md bg-instagram"><i class="font-xs ti-instagram text-white"></i></a></li>
                                <li class="list-inline-item"><a href="{{$links[2]->link}}" class="btn-round-md bg-twiiter"><i class="font-xs ti-twitter-alt text-white"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
