@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="about-wrapper pb-lg--7 pt-lg--7 pt-5 pb-7">
            @if ($data)
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mt-5">
                            <p class="text-grey-900 fw-700 font-xxl pb-2 mb-0 mt-3 d-block lh-3">من نحن؟</p>
                            <h2 class="text-grey-900 font-l pb-2 mb-0 mt-3 d-block lh-3">{!! $data->text !!}</h2>
                        </div>

                        <div class="col-lg-6 mt-3">
                            <a href="#"><img src="{{$data->image_path}}" alt="about" class="img-fluid rounded-lg"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 offset-lg-1 mt-5">
                            <ul class="d-block list-inline float-right-md mb-3">
                                <li class="list-inline-item mr-1"><a href="{{$links[0]->link}}" class="btn-round-md bg-facebook"><i class="font-xs ti-facebook text-white"></i></a></li>
                                <li class="list-inline-item mr-1"><a href="{{$links[1]->link}}" class="btn-round-md bg-instagram"><i class="font-xs ti-instagram text-white"></i></a></li>
                                <li class="list-inline-item mr-1"><a href="{{$links[2]->link}}" class="btn-round-md bg-twiiter"><i class="font-xs ti-twitter-alt text-white"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @include('landing.sections.brands')
        @include('landing.footer')
    </div>
@endsection
