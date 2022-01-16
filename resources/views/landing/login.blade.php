@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat" style="background-image: url({{asset('/public/web/images//index/login-bg.jpg')}});"></div>
            <div class="col-xl-7 vh-lg-100 align-items-center d-flex bg-white rounded-lg overflow-hidden">
                <div class="card shadow-none border-0 ml-auto mr-auto login-card">
                    <div class="card-body rounded-0 text-left">
                        <h2 class="fw-700 display1-size display2-md-size mb-3">تسجيل دخول حسابك</h2>
                        @if ($errors->any())
                            <div class="alert alert-danger" id="Error">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal form-simple"  method="POST" action="{{ route('user.login') }}">
                            @csrf
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pr-0"></i>
                                <input type="text" name="email" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="البريد الإلكتروني">
                            </div>
                            <div class="form-group icon-input mb-1">
                                <input type="Password" name="password" class="style2-input pl-5 form-control text-grey-900 font-xss ls-3" placeholder="كلمة المرور">
                                <i class="font-sm ti-lock text-grey-500 pr-0"></i>
                            </div>
                            <button class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0" type="submit">تسجيل الدخول</button>
                        </form>

                        <div class="col-sm-12 p-0 text-left">
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">ليس لديك حساب؟ <a href="{{route('user.register')}}" class="fw-700 ml-1">التسجيل</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
