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
                <li class="breadcrumb-item active">من نحن
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
                <form class="form" action="{{route('about.store')}}" method="post" id="activityForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="projectinput1"> نص   </label>
                                    <textarea type="text" class="form-control ckeditor"   name="text" id="description" required  placeholder="الوصف">{!! !is_null($about)?$about->text:'' !!}</textarea>
                                </div>
                            </div>
                        </div>
                       
                     
                       
                       
                        صورة    
                        <div class="row">
                                <div class="col-sm-6">
                                @if(!is_null($about))
                                <img src="{{asset('public/uploads/about/'.$about->image)}}" width="50%"  height="50%" id="preview_image" class="img-thumbnail">

                                @else
                                <img src="https://cdn.shopify.com/app-store/listing_images/bd8e69a3e7e7f8a886a62cffb893d8d2/icon/CNjlo7P0lu8CEAE=.jpg" width="50%"  height="50%" id="preview_image" class="img-thumbnail">

                                @endif
                                </div>
                            <div class="ml-2 mt-1 col-sm-6">
                                <div id="msg"></div>
                                    <input type="file" name="image" class="image" accept="image/*">
                            </div>
                        </div>



                    </div>

                    <div class="form-actions mt-2">
                         <input type="hidden" name="slug" id="action" value="slug">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> حفظ</button>
                    </div>

                </form>
            </div>
            </div>

    </div>
 @endsection
 @section('script')
 <script>
     $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".image");
        file.trigger("click");
        });
        $('.image').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview_image").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
        });

        $('.image_in_right_page').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview_image_in_right_page").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
        });
        $(document).on("click", ".add-point", function() {
           var html = ` <div class="col-md-12">
                                <div class="form-group">
                                    <textarea cols="40" required placeholder="عنوان" name="title_points_left_middle_image[]" rows="3"></textarea>
                                    <textarea cols="40" required placeholder="وصف" name="description_points_left_middle_image[]" rows="3"  ></textarea>
                                    <span style="position: relative;top: 10p;bottom: 17px;" class="btn btn-danger mb-2 remove-point">-</span>
                                </div>
                            </div>`;
         $(".points").append(html);

        });
        $(document).on("click", ".remove-point", function() {
            $(this).parent().parent().remove()
        });
 </script>
 @endsection
