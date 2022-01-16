@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="container register-form">
            <div class="row">
                <div class="col-xl-12 d-flex bg-white">
                    <div class="card shadow-none border-0 login-card pt-10">
                        <div class="card-body rounded-0 text-left">
                            <h2 class="fw-700 display1-size display2-md-size mb-4">نموذج التسجيل</h2>
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
                                <div class="alert alert-primary text-center">
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif

                            <form method="POST" action="{{route('store.register-form')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="name" id="name" type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="الاسم بالكامل" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="mobile_number" type="number" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="رقم الجوال" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="employment" type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="مجال العمل"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="country" type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="اسم الدولة" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="place_of_residence" type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="مكان الإقامة" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="id_number" type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="رقم السجل المدني أو رقم الهوية" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="nationality" type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="الجنسية" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group icon-input mb-3">
                                            <input name="code" type="text" class="style2-input pl-5 form-control text-grey-900 font-xsss fw-600" placeholder="رمز الكود ان وجد">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="font-weight-bold">الدبلوم / الماجستير المهتم به</p>
                                        @foreach ($data as $interest)
                                            <div class="form-group">
                                                <input type="checkbox" name="interests[]" value="{{$interest->id}}">
                                                <label>{{$interest->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0" type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
