@extends('app')
@section('content')

    @include('user.sections.nav')

    <div class="main-content">
        @include('user.sections.topSidebar')

        <div class="middle-sidebar-bottom bg-lightblue theme-dark-bg">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                        <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-lg">
                            <a href="{{route('user.settings')}}" class="d-inline-block mt-2"><i class="ti-arrow-left font-sm text-white"></i></a>
                            <h4 class="font-xs text-white fw-600 ml-4 mb-0 mt-2">تغيير كلمة المرور</h4>
                        </div>
                        <div class="card-body p-lg-5 p-4 w-100 border-0">

                            @if ($errors->any())
                            <div class="alert alert-danger" id="Error">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('user.changePassword') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss"  >كلمة المرور الحالية</label>
                                            <input type="password" class="form-control" name="old_password">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss"  >كلمة المرور الجديدة</label>
                                            <input type="password" class="form-control" name="new_password">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss"  >تأكيد كلمة المرور الجديدة</label>
                                            <input type="password" class="form-control" name="confirm_password">
                                        </div>
                                    </div>
                                </div>

                                <button class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0" type="submit">تعديل البيانات</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
