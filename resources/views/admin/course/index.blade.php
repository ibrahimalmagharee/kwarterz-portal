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
                        <li class="breadcrumb-item active">الدورات
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
                                <h4 class="card-title">كل الدورات </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <a href="{{route('course.create')}}" class="btn btn-primary btn-sm " id="add-course"><i class="ft-plus white"></i>اضافة دورة جديدة  </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content collapse show" id="viewCourse">
                            <div class="card-body card-dashboard table-responsive">
                                <table class="table course-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الناشر</th>
                                            <th>الاسم</th>
                                            <th>السعر</th>
                                            <th>عدد الساعات</th>
                                            <th>الأقسام </th>
                                            <th>المحاضرات </th>
                                            <th>التصنيف </th>
                                            <th>عرض </th>
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
                        <h5>هل أنت متأكد من حذف هذا الكورس !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">الغاء</button>
                        <button type="submit" class="btn btn-danger" id="delete">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script type="text/javascript">
    CKEDITOR.config.language = 'ar';
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Show Table
        var courseTable = $('.course-table').DataTable({
            "language": {
                "url": "{{asset('/public/datatables-ar.json')}}"
            },
            'pagingType': 'full_numbers',
            'lengthMenu': [
                [6, 10, 20, 30, 40, -1],
                [6, 10, 20, 30, 40, 'الكل']
            ],
            processing: true,
            serverSide: true,
            ajax: "{{route("course.index")}}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex' ,orderable: false, searchable: false},
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'hours',
                    name: 'hours'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'sections',
                    name: 'sections'
                },
                {
                    data: 'lessons',
                    name: 'lessons'
                },
                {
                    data: 'category_id',
                    name: 'category_id'
                },
                {
                    data: 'show',
                    name: 'show'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        //Delete

        $('body').on('click', '.deleteCourse', function(ee) {
            ee.preventDefault();
            var id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#delete').click(function(e) {
                e.preventDefault();
                $.ajax({

                    url: '/kwarterz-portal/admin/course/' + id,
                    type: 'delete',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(data) {
                        console.log('success:', data);
                        if (data.status === true) {
                            $('#delete-modal').modal('hide');
                            toastr.warning(data.msg);
                            courseTable.draw();
                        }

                    }

                });
            });

            $('#cancel').click(function() {
                $('#delete-modal').modal('hide');
            });
        });

        $('body').on('click', '.makeSlider', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                                $.ajax({

                                    url: '{{route('course.makeSlider')}}',
                                    type: 'POST',
                                    data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                    },
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) {
                                            courseTable.draw();
                                        }

                                    }

                                });



            });
            $('body').on('click', '.removeSlider', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                                $.ajax({

                                    url: '{{route('course.removeSlider')}}',
                                    type: 'POST',
                                    data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": id
                                    },
                                    success: function (data) {
                                        console.log('success:', data);
                                        if (data.status === true) {
                                            courseTable.draw();
                                        }

                                    }

                                });



            });





    });
</script>
@endsection
