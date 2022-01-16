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
                <li class="breadcrumb-item active">{{isset($slider)?'تعديل':'اضافة'}}
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
                <form class="form" action="{{isset($slider)?route('slider.update',$slider->id):route('slider.store')}}" method="post" id="sliderForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> النص</label>
                                    <input type="text" id="name" class="form-control" placeholder="العنوان"
                                            name="text" value="{{isset($slider)?$slider->text:old('text')}}">
                                    </div>
                            </div>
                        </div>
                     
                        <div class="row">
                               
                                <div class="col-sm-6">
                                @if(isset($slider))
                                    <img src="{{asset('public/uploads/sliders/'.$slider->image)}}" width="50%"  height="50%" id="preview" class="img-thumbnail">
                                @else
                                <img src="https://cdn.shopify.com/app-store/listing_images/bd8e69a3e7e7f8a886a62cffb893d8d2/icon/CNjlo7P0lu8CEAE=.jpg" width="50%"  height="50%" id="preview" class="img-thumbnail">

                                @endif
                                </div>
                            <div class="ml-2 mt-1 col-sm-6">
                                <div id="msg"></div>
                                    <input type="file" name="image" class="file" accept="image/*">
                            </div>
                        </div>


                    </div>

                    <div class="form-actions mt-2">
                         <input type="hidden" name="id" id="action" value="id">
                        <button class="btn btn-primary" type="submit"><i class="la la-save"></i> {{isset($slider)?'تعديل':'حفظ'}}</button>
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
