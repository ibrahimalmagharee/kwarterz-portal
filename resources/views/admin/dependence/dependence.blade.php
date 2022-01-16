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
                <li class="breadcrumb-item active">اعتماداتنا
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
                <form class="form" action="{{route('dependence.store')}}" method="post" id="activityForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="projectinput1">النص</label>
                                    <textarea type="text" class="form-control ckeditor"   name="text" id="description" required  placeholder="الوصف">{!! !is_null($dependence)?$dependence->text:'' !!}</textarea>
                                </div>
                            </div>
                        </div>
                      
                       
                       
                        
                        <div class="row">
                            @if(!is_null($dependence))
                        @foreach($dependence->images as $image)
                                <div class="col-sm-3">
                                <span class="btn btn-danger deleteImage"  data-image="{{$image->name}}">حذف</span>
                                <img src="{{asset('/public/uploads/dependence/'. $image->name)}}" width="50%"  height="50%" id="preview_image_in_middle" class="img-thumbnail">

                                </div>
                         @endforeach 
                         @endif      
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="photo1">
                                    <div class="form-body">

                                        <h4 class="form-section"> رفع الصور </h4>
                                        <div class="form-group">
                                            <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                                            </div>
                                            <br><br>
                                        </div>


                                    </div>
                                </div>
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
            {{-- Confirmation Modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">تأكيد عملية الحذف</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>هل أنت متأكد من حذف هذه الصورة !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">الغاء</button>
                        <button type="submit" class="btn btn-danger" id="delete">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Confirmation Modal --}}
    </div>
 @endsection
 @section('script')
 <script>
    var uploadedDocumentMap = {}

Dropzone.options.dpzMultipleFiles = {
    paramName: "dzfile", // The name that will be used to transfer the file
    //autoProcessQueue: false,
    maxFilesize: 5, // MB
    clickable: true,
    addRemoveLinks: true,
    acceptedFiles: 'image/*',
    dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
    dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
    dictCancelUpload: "الغاء الرفع ",
    dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
    dictRemoveFile: "حذف الصوره",
    dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
    headers: {
        'X-CSRF-TOKEN':
            "{{ csrf_token() }}"
    }
    ,
    url: "{{route('dependence.uploadImageAjax')}}", // Set the url
    success:
        function (file, response) {
            $('form').append('<input type="hidden" name="images[]" id="photo" value="' + response.imageName + '">')
            uploadedDocumentMap[file.name] = response.imageName
        }
    ,

    removedfile: function(file)
    {
        var name = file.upload.filename;

        $.ajax({
            type: 'GET',
            url: '{{route('dependence.removeImageAjaxDropzone')}}',
            data: {filename:name},

            success: function(file, name)
            {
                console.log(name);
                file.upload.filename=name;
            },
            error: function(e) {
                console.log(e);
            }});
        var fileRef;
        return (fileRef = file.previewElement) != null ?
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },

    // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
    init: function () {
            @if(isset($event) && $event->images)
        var files;
        {!! json_encode($event->images) !!}
            for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="images[]" id="photo" value="' + file.file_name + '">')
        }
        @endif
    }
}
        $('body').on('click', '.deleteImage', function (ee) {
            ee.preventDefault();
            var sele =  $(this);
                            var image = $(this).data('image');
                            $('#delete-modal').modal('show');
                            $('#delete').click(function (e) {
                                e.preventDefault();
                                $.ajax({

                                    type: 'GET',
                                    url: '{{route('dependence.removeImageAjax')}}',
                                    data: {filename:image},
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) {
                                            $('#delete-modal').modal('hide');
                                            sele.parent().remove();
                                            toastr.warning(data.msg);
                                           
                                        }

                                    }

                                });
                            });

                            $('#cancel').click(function () {
                                $('#delete-modal').modal('hide');
                            });

        });
 </script>
 @endsection
