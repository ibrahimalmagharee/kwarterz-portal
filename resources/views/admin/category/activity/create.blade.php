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
                <li class="breadcrumb-item active">التصنيفات
                </li>
                <li class="breadcrumb-item"><a href="{{route('category.activity.index')}}">أنشطة</a>
                </li>
                <li class="breadcrumb-item active">{{isset($category)?'تعديل':'اضافة'}}
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
                <form class="form" action="{{isset($category)?route('category.activity.update',$category->id):route('category.activity.store')}}" method="post" id="newsForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> اسم الصنف</label>
                                    <input type="text" id="name" class="form-control" placeholder="اسم الصنف"
                                            name="name" value="{{isset($category)?$category->name:old('name')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="type" id="action" value="activity">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($category)?'تعديل':'حفظ'}}</button>
                    </div>

                </form>
            </div>
            </div>
           
    </div>
 @endsection