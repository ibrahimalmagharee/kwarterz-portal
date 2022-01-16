@extends('app')
@section('content')
    <div class="main-wrap">
        @include('landing.header')
        <div class="section section-contact-us">
            <div class="map-wrapper pb-lg--7 pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="contact-wrap bg-white shadow-lg rounded-lg position-relative">
                                <h1 class="text-grey-900 fw-700 display3-size mb-5 lh-1">تواصل معنا</h1>
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
                                <form method="POST" action="{{route('store.contact')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="text" name="name" class="form-control style2-input bg-color-none text-grey-700" placeholder="الاسم">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group mb-3">
                                                <input type="email" name="email" class="form-control style2-input bg-color-none text-grey-700" placeholder="البريد الإلكتروني">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group mb-3 md-mb25">
                                                <textarea name="message" class="w-100 h125 style2-textarea p-3 form-control" placeholder="الرسالة"></textarea>
                                            </div>
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
        @include('landing.footer')
    </div>
@endsection
