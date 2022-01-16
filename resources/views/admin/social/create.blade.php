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
                <li class="breadcrumb-item"><a href="{{route('social.index')}}">وسائل التواصل</a>
                </li>
                <li class="breadcrumb-item active">{{'تعديل'}}
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
                <form class="form" action="{{route('social.update',$social->id)}}" method="post" id="companyForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> الاسم</label>
                                    <input type="text" id="name" class="form-control" placeholder="الاسم"
                                            name="name" value="{{$social->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> الرابط</label>
                                    <input type="text" id="link" class="form-control" placeholder="الرابط"
                                            name="link" value="{{$social->link}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> تعديل</button>
                    </div>

                </form>
            </div>
            </div>
           
    </div>
 @endsection