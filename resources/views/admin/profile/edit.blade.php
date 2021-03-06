@extends('layouts.admin')
@section('content')
<div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">الرئيسية</a></li>
                                <li class="breadcrumb-item active"> تعديل الملف الشخصي ل - {{Auth::user()->name}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center"><strong> تعديل الملف الشخصي ل
                                            - {{Auth::user()->name}} </strong></h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">

                                        </ul>
                                    </div>
                                </div>


                            <!--  Begin Form Edit -->
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" id="categoryFormLocale" method="post"
                                              action="{{route('admin.profile.update')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i class="ft-home"></i> تعديل الملف الشخصي ل
                                                - {{auth::user()->name}}</h4>
                                            <input type="hidden" name="id" value="{{Auth::user()->id}}">

                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">الاسم </label>
                                                            <input type="text" id="name" class="form-control" placeholder="" name="name" value="{{Auth::user()->name}}">

                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">البريد الالكتروني</label>
                                                            <input type="email" id="email" class="form-control" placeholder="" name="email" value="{{Auth::user()->email}}">

                                                            @error('email')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">كلمة المرور الجديدة </label>
                                                            <input type="password" id="password" class="form-control" placeholder="" name="password">

                                                            @error('password')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">تأكيد كلمة المرور</label>
                                                            <input type="password" id="password_confirmation" class="form-control" placeholder="" name="password_confirmation">

                                                            @error('password')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>

                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
@endsection
