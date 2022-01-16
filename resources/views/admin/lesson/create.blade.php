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
                <li class="breadcrumb-item"><a href="{{route('lesson.index',$course->slug)}}">الدروس</a>
                </li>
                <li class="breadcrumb-item active">{{isset($lecture)?'تعديل':'اضافة'}}
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
                <form class="form" action="{{isset($lecture)?route('lesson.update',[$course->slug,$lecture->slug]):route('lesson.store',$course->slug)}}" method="post" id="newsForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> عنوان الدرس</label>
                                    <input type="text" id="title" class="form-control" placeholder="عنوان الدرس"
                                            name="title" value="{{isset($lecture)?$lecture->title:old('title')}}">
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1"> الوصف</label>
                                    <textarea type="text" class="form-control ckeditor"   name="description" id="description" required  placeholder="الوصف">{{isset($lecture)?$lecture->description:old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="projectinput1">القسم </label>
                                <select class="select2-language form-control select-custom" name="section_id" id="select2-language">
                                    @foreach($sections as $sec)
                                    <option value="{{$sec->id}}" {{isset($lecture)?$sec->id == $lecture->section_id?'selected':'':''}} >{{$sec->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <label> الفيديو </label>
                            <label id="projectinput7" class="file center-block">
                                <input type="file" id="lecture" name="lecture">
                                <span class="file-custom"></span>
                            </label>
                        </div>
                    </div>
                    </div>

                    <div class="form-actions">
                         <input type="hidden" name="slug" id="action" value="slug">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($lecture)?'تعديل':'حفظ'}}</button>
                    </div>

                </form>
            </div>
            </div>
           
    </div>
 @endsection