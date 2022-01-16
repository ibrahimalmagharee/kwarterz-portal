@extends('app')
@section('content')
    @include('user.sections.nav')
    <div class="main-content">
        @include('user.sections.topSidebar')
        <div class="course-details pt-lg--7 pb-lg--7 pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 col-lg-12">
                        <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-lg mb-3">
                            <h4 class="font-xs text-white fw-600 ml-4 mb-0 mt-2 w-100 text-center">دورة {{$purchased->course->title}}</h4>
                        </div>
                        <div class="card border-0 mb-0 rounded-lg overflow-hidden">
                            <div class="player shadow-none">
                                <video class="video-path" width="100%"  controls>
                                    <source class="video-mp4" src="{{$purchased->course->sections[0]->lectures[0]->video_path}}" type="video/mp4">
                                    <source class="video-mov" src="{{$purchased->course->sections[0]->lectures[0]->video_path}}" type="video/mov">
                                    <source class="video-ogg" src="{{$purchased->course->sections[0]->lectures[0]->video_path}}" type="video/ogg">
                                    <source class="video-qt" src="{{$purchased->course->sections[0]->lectures[0]->video_path}}" type="video/qt">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>

                        <div class="card d-block border-0 rounded-lg overflow-hidden mt-2">
                            <div id="accordion" class="accordion mb-0">
                                @foreach ($purchased->course->sections as $section)
                                    <div class="card shadow-xss mb-0">
                                        <div class="card-header bg-greylight theme-dark-bg" id="heading{{$section->id}}">
                                            <h5 class="mb-0"><button class="btn font-xsss fw-600 btn-link " data-toggle="collapse" data-target="#collapse{{$section->id}}" aria-expanded="false" aria-controls="collapse{{$section->id}}"> {{$section->name}} </button></h5>
                                        </div>
                                        <div id="collapse{{$section->id}}" class="collapse p-3 show" aria-labelledby="heading{{$section->id}}" data-parent="#accordion">
                                            @foreach ($section->lectures as  $index => $lecture)
                                                <div class="card-body d-flex p-2">
                                                    <span class="bg-current btn-round-xs rounded-lg font-xssss text-white fw-600">{{$index + 1}}</span>
                                                    <span style="cursor: pointer" class="font-xssss fw-500 text-grey-500 mr-2" data-action="change-lecture" data-id="{{$lecture->id}}">{{$lecture->title}}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card d-block border-0 rounded-lg overflow-hidden p-4 shadow-xss mt-4">
                            <h2 class="fw-700 font-sm mb-3 mt-1 pl-1 mb-3">الوصف</h2>
                            <p class="font-xssss fw-500 lh-28 text-grey-600 mb-0 pl-2">{!! $purchased->course->description !!}</p></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $( document ).ready(function() {
            $('#accordion').on('click', '[data-action="change-lecture"]', function() {
                $('.card-body').css( "background-color", "#fff" );
                var lecture_id = $(this).attr('data-id');
                $(this).parent().css( "background-color", "#6ce7ab" );

                $.get($("meta[name='BASE_URL']").attr("content") + `/get-lecture-video/${lecture_id}`, function (response) {
                    $('.video-path .video-mp4').attr('src', response);
                    $('.video-path .video-mov').attr('src', response);
                    $('.video-path .video-ogg').attr('src', response);
                    $('.video-path .video-qt').attr('src', response);
                    $(".video-path")[0].load();
                });
            });

        });
    </script>
@endsection
