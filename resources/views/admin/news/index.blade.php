@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title"></h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">الرئيسية</a>
                </li>
                <li class="breadcrumb-item active">الأخبار
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
      <div class="content-body">
     <section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
              <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title">كل الاخبار</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                      <a href="{{route('news.create')}}" class="btn btn-primary btn-sm " id="add-new"><i class="ft-plus white"></i>اضافة خبر جديد</a>
                    </div>
                  </div>
        </div>
                <div class="card-content collapse show" id="viewNews">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table news-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>العنوان</th>
                                                <th>ناشر الخبر</th>
                                                <th>الصورة</th>
                                                <th>التفاصيل</th>
                                                <th>الاعدادات </th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="justify-content-center d-flex"></div>
                                    </div>
                                </div>
              </div>
            </div>
          </div>
        </section>


      </div>
    </div>
    <div class="modal fade modal-open" id="news-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة تاجر
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="newsForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label> اضف صورة</label>
                                        <label id="projectinput7" class="file center-block">
                                            <input type="file" id="image" name="image">
                                            <span class="file-custom"></span>
                                        </label>
                                        <span id="image_error" class="text-danger"> </span>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> العنوان</label>
                                                <input type="text" id="name" class="form-control" placeholder="العنوان"
                                                       name="title" value="{{old('title')}}">
                                                <span id="title_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> المحتوى</label>
                                                <textarea type="text"  class="form-control ckeditor"  name="new"  cols="30" rows="15" >
                                                </textarea>
                                                <span id="new_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addNew"><i class="la la-save"></i> حفظ</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                        <h5>هل أنت متأكد من حذف هذا الخبر !!</h5>
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
    {{-- show Modal --}}
    <div class="modal fade" id="show-new-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog center" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="new-title">العنوان</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="show-content-new">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
      </div>
    </div>
  </div>
</div>
    {{-- End show Modal --}}
@endsection

@section('script')

    <script type="text/javascript">
        CKEDITOR.config.language = 'ar';
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Show Table
            var newsTable = $('.news-table').DataTable({
                "language": {
                 "url": "{{asset('/public/datatables-ar.json')}}"
                    },
                'pagingType':'full_numbers',
                'lengthMenu':[[6,10,20,30,40,-1],[6,10,20,30,40,'الكل']],
                processing: true,
                serverSide: true,
                ajax: "{{route("news.index")}}",
                columns: [
                  // {data: 'DT_RowIndex', name: 'DT_RowIndex' ,orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'image', name: 'image'},
                    {data: 'show', name: 'show'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });


            //Show Form
            $('#add-new').click(function () {
                // $('#newsForm').trigger('reset');
                // $('#news-modal').modal('show');

            });
             //Add Or Update
             $(document).on('click', '#addNew', function (e) {
                e.preventDefault();
                var formData = new FormData($('#newsForm')[0]);
                $('#title_error').text('');
                $('#new_error').text('');
                $('#image_error').text('');
                var desc = CKEDITOR.instances['new'].getData();
                formData.append('new',desc)
                $.ajax({
                    type: 'post',
                    url: "{{ route('news.store') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        $('#newsForm').trigger('reset');
                        $('#news-modal').modal('hide');
                        if (data.status == true) {
                            $('.ckeditor').text('');
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                        }
                        newsTable.draw();

                    },

                    error: function (reject) {
                        console.log('Error: not added', reject);
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });

                    }

                });
            });

            //Delete

            $('body').on('click', '.deleteNew', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                            $('#delete-modal').modal('show');
                            $('#delete').click(function (e) {
                                e.preventDefault();
                                $.ajax({

                                    url: '/admin/news/'+id,
                                    type: 'delete',
                                    data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                    },
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) {
                                            $('#delete-modal').modal('hide');
                                            toastr.warning(data.msg);
                                            newsTable.draw();
                                        }

                                    }

                                });
                            });

                            $('#cancel').click(function () {
                                $('#delete-modal').modal('hide');
                            });
            });
            $('body').on('click', '.showNew', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                                   $.ajax({
                                    url: '/admin/news/'+id,
                                    type: 'get',
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) {
                                            $('#show-content-new').html(data.new.content)
                                            $('#new-title').html(data.new.title)
                                            $('#show-new-modal').modal('show');
                                        }

                                    }
                                    });
            });



            $('body').on('click', '.makeSlider', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                                $.ajax({

                                    url: '{{route('news.makeSlider')}}',
                                    type: 'POST',
                                    data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                    },
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) { 
                                            newsTable.draw();
                                        }

                                    }

                                });
                         

                          
            });
            $('body').on('click', '.removeSlider', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                                $.ajax({

                                    url: '{{route('news.removeSlider')}}',
                                    type: 'POST',
                                    data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                    },
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) { 
                                            newsTable.draw();
                                        }

                                    }

                                });
                         

                          
            });


        });
    </script>
@endsection
