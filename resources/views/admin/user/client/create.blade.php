@extends('layouts.admin')

@section('content')
<div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title"></h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">الرئيسية</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('client.index')}}">العملاء</a>
                </li>
                <li class="breadcrumb-item active">{{isset($client)?'تعديل':'اضافة'}}
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">

          </div>
        </div>
      </div>

    <div class="card-content collapse show">

            <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger" id="Error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form class="form" action="{{isset($client)?route('client.update',$client->id):route('client.store')}}" method="post" id="newsForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> الاسم</label>
                                    <input type="text" id="name" class="form-control" placeholder="اسم"
                                            name="name" value="{{isset($client)?$client->name:old('name')}}">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email"> البريد الإلكتروني</label>
                                    <input type="email" id="email" class="form-control" placeholder="البريد الإلكتروني"
                                            name="email" value="{{isset($client)?$client->email:old('email')}}">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="national"> الجنسية</label>
                                    <input type="text" id="national" class="form-control" placeholder="الجنسية"
                                            name="national" value="{{isset($client)?$client->national:old('national')}}">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="mobile_number"> رقم الجوال</label>
                                    <input type="number" id="mobile_number" class="form-control" placeholder="رقم الجوال"
                                            name="mobile_number" value="{{isset($client)?$client->mobile_number:old('mobile_number')}}">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1">كلمة المرور</label>
                                    <input type="password" id="password" class="form-control" placeholder="كلمة المرور"
                                            name="password">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1">تأكيد كلمة المرور</label>
                                    <input type="password" id="password_confirm" class="form-control" placeholder="تأكيد كلمة المرور"
                                            name="password_confirm">
                                  </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($client)?'تعديل':'حفظ'}}</button>
                    </div>

                </form>
            </div>
            </div>

    </div>
 @endsection
