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
                            <h4 class="font-xs text-white fw-600 ml-4 mb-0 mt-2">تفاصيل الحساب</h4>
                        </div>
                        <div class="card-body p-lg-5 p-4 w-100 border-0 ">

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

                        <form method="POST" action="{{ route('user.updateAccountInformation') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">الاسم</label>
                                        <input type="text" class="form-control" name="name" value="{{\Auth::user()->name}}">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">الجنسية</label>
                                        <input type="number" class="form-control" name="national" value="{{\Auth::user()->national}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" name="email" value="{{\Auth::user()->email}}">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">رقم الجوال</label>
                                        <input type="number" class="form-control" name="mobile_number" value="{{\Auth::user()->mobile_number}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">العنوان</label>
                                        <input type="text" class="form-control" name="address" value="{{\Auth::user()->address}}">
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
