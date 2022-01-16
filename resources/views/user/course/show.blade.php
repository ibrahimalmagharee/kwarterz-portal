@extends('app')
@section('content')
    @include('user.sections.nav')
    <div class="main-content">
        @include('user.sections.topSidebar')

        <div class="course-details pt-lg--5 pb-lg--5 pt-5 pb-5">
            <div class="container">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-xl-8 col-xxl-9 ">
                        <div class="card border-0 mb-0 rounded-lg overflow-hidden" style="background-image: url({{$course->image_path}});">
                            <div class="card-body p-5 bg-black-08">
                                <span class="font-xsssss fw-700 pl-3 pr-3 lh-32 text-uppercase rounded-lg ls-2 alert-warning d-inline-block text-warning mr-1">{{$course->category->name}}</span>
                                <h2 class="fw-700 font-lg d-block lh-4 mb-1 text-white mt-2">{{$course->title}}</h2>
                                @if ($course->short_description)
                                    <p class="font-xsss fw-500 text-grey-100 lh-30 pl-5 mt-3 ml-5">{!! $course->short_description !!}</p>
                                @endif
                                <div class="clearfix"></div>

                                <button style="border: none; background: transparent" class="btn-round-lg d-inline-block rounded-lg bg-greylight" onclick="copyToClipboard()">
                                    <i class="feather-share-2 font-sm text-grey-700"></i>
                                </button>
                                @if ($course->is_saved(\Auth::user()->id))

                                    <form method="post" action="{{ route('user.unsave.course', ['course_id' => $course->id]) }}" class="form-save-course">
                                        {!! method_field('delete') !!}
                                        @csrf
                                        <button class="btn-round-lg mr-2 d-inline-block rounded-lg bg-success"><i class="feather-bookmark font-sm text-white"></i> </button>
                                    </form>
                                    @else

                                    <form method="post" action="{{ route('user.save.course', ['course_id' => $course->id]) }}" class="form-save-course">
                                        @csrf
                                        <button class="btn-round-lg mr-2 d-inline-block rounded-lg bg-danger"><i class="feather-bookmark font-sm text-white"></i> </button>
                                    </form>

                                @endif
                            </div>
                        </div>

                        @if ($course->benefit)
                            <div class="card d-block border-0 rounded-lg overflow-hidden p-4 shadow-xss mt-4 alert-success">
                                <h2 class="fw-700 font-sm mb-3 mt-1 pl-1 text-success mb-4">ماذا سنتعلم في هذه الدورة ؟</h2>
                                <h4 class="font-xssss fw-600 text-grey-600 mb-3 pl-30 position-relative lh-24">{!! $course->benefit !!}</h4>
                            </div>
                        @endif
                        <div class="card d-block border-0 rounded-lg overflow-hidden p-4 shadow-xss mt-4">
                            <h2 class="fw-700 font-sm mb-3 mt-1 pl-1 mb-3">الوصف</h2>
                            <p class="font-xssss fw-500 lh-28 text-grey-600 mb-0 pl-2">{!! $course->description !!}</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-3 ">
                        <div class="card overflow-hidden subscribe-widget p-3 mb-3 rounded-xxl border-0 shadow-xss">
                            <div class="card-body p-3 d-block text-left">
                                <h1 class="display1-size text-current fw-700 mb-4">{{$course->price}} دينار أردني<span class="font-xssss text-grey-500 fw-500"></span></h1>
                                 <h4 class="pl-35 mb-4 font-xsss fw-600 text-grey-900 position-relative"><i class="feather-shield font-lg text-current position-absolute left-0"></i> عدد الساعات <span class="d-block text-grey-500 mt-1 font-xssss">{{$course->hours}} </span></h4>
                                 <a href="{{route('user.purchase.course', $course->slug)}}" class="bg-primary-gradiant border-0 text-white fw-600 text-uppercase font-xssss float-left rounded-lg d-block mt-4 w-100 p-2 lh-34 text-center ls-3 ">شراء الآن</a>
                            </div>
                        </div>

                        <div class="card shadow-xss rounded-lg border-0 p-4 mb-4">
                            <h4 class="font-xs fw-700 text-grey-900 d-block mb-3">الأقسام</h4>
                            @foreach ($course->sections as $index => $section)
                                <div class="card-body d-flex p-0 mt-3">
                                    <span class="bg-current btn-round-xs rounded-lg font-xssss text-white fw-600">{{$index + 1}}</span>
                                    <span class="font-xssss fw-500 text-grey-500 mr-2">{{$section->name}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function copyToClipboard(text) {
            var inputc = document.body.appendChild(document.createElement("input"));
            inputc.value = window.location.href;
            inputc.focus();
            inputc.select();
            document.execCommand('copy');
            inputc.parentNode.removeChild(inputc);
            alert("تم نسخ الرابط بنجاح");
        }
    </script>
@endsection
