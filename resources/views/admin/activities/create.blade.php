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
                <li class="breadcrumb-item"><a href="{{route('activity.index')}}">الأنشطة</a>
                </li>
                <li class="breadcrumb-item active">{{isset($activity)?'تعديل':'اضافة'}}
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
                <form class="form" action="{{isset($activity)?route('activity.update',$activity->slug):route('activity.store')}}" method="post" id="activityForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> العنوان</label>
                                    <input type="text" id="name" class="form-control" placeholder="العنوان"
                                            name="title" value="{{isset($activity)?$activity->title:old('title')}}">
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput2"> العنوان الفرعي</label>
                                    <input type="text" id="subtitle" class="form-control" placeholder="العنوان الفرعي" name="subtitle" value="{{isset($activity)?$activity->subtitle:old('subtitle')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="projectinput1"> الوصف</label>
                                    <textarea type="text" class="form-control ckeditor"   name="description" id="description" required  placeholder="الوصف">{{isset($activity)?$activity->description:old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="projectinput1"> التاريخ</label>
                                    <fieldset class="form-group">
                                        <input type="datetime-local" class="form-control" name="date" id="dateTime" value="2021-08-19T13:45:00">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="projectinput1"> نوع النشاط</label>
                                <select class="select2-language form-control select-custom" name="category_id" id="select2-language">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{isset($activity)?$activity->category_id == $category->id?'selected':'':''}} >{{$category->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-6">
                                    <img src="https://cdn.shopify.com/app-store/listing_images/bd8e69a3e7e7f8a886a62cffb893d8d2/icon/CNjlo7P0lu8CEAE=.jpg" width="50%"  height="50%" id="preview" class="img-thumbnail">
                                </div>
                            <div class="ml-2 mt-1 col-sm-6">
                                <div id="msg"></div>
                                    <input type="file" name="image" class="file" accept="image/*">
                            </div>
                        </div>


                    </div>

                    <div class="form-actions mt-2">
                         <input type="hidden" name="slug" id="action" value="slug">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($activity)?'تعديل':'حفظ'}}</button>
                    </div>

                </form>
            </div>
            </div>

    </div>
 @endsection
 @section('script')
 <script>
     $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
        });
 </script>
 @endsection
