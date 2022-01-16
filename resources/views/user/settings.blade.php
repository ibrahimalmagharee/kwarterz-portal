@extends('app')
@section('content')

    @include('user.sections.nav')

    <div class="main-content">
        @include('user.sections.topSidebar')

        <div class="middle-sidebar-bottom bg-lightblue theme-dark-bg">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                        <div class="card-body p-lg-5 p-4 w-100 border-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="mb-4 font-lg fw-700 mont-font mb-5">الإعدادات</h4>
                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">العام</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom mr-0"><a href="{{route('user.accountInformation')}}" class="pt-2 pb-2 d-flex"><i class="btn-round-md bg-primary-gradiant text-white feather-home font-md ml-3"></i> <h4 class="fw-600 font-xssss mb-0 mt-3">معلومات الحساب</h4><i class="ti-angle-right font-xsss text-grey-500 mr-auto mt-3"></i></a></li>
                                    </ul>

                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">الحساب</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block  mr-0"><a href="{{route('user.changePassword')}}" class="pt-2 pb-2 d-flex"><i class="btn-round-md bg-blue-gradiant text-white feather-inbox font-md ml-3"></i> <h4 class="fw-600 font-xssss mb-0 mt-3">كلمة المرور</h4><i class="ti-angle-right font-xsss text-grey-500 mr-auto mt-3"></i></a></li>

                                    </ul>

                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">أخرى</div>
                                    <ul class="list-inline">
                                        <form method="post" action="{{ route('logout') }}">
                                            @csrf
                                            <li class="list-inline-item d-block mr-0"><a href="#" class="pt-2 pb-2 d-flex"><i class="btn-round-md bg-red-gradiant text-white feather-lock font-md ml-3"></i> <button type="submit" class="btn-logout">تسجيل الخروج</button><i class="ti-angle-right font-xsss text-grey-500 mr-auto mt-3"></i></a></li>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
