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
                        <li class="breadcrumb-item active">التصنيفات
                        </li>
                        <li class="breadcrumb-item active">الأنشطة
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
                                <h4 class="card-title">كل تصنيفات الأنشطة</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <a href="/admin/category/activity/create" class="btn btn-primary btn-sm " id="add-category"><i class="ft-plus white"></i>اضافة صنف جديد </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content collapse show" id="viewCategory">
                            <div class="card-body card-dashboard table-responsive">
                                <table class="table category-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>الناشر</th>
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
                        <h5>هل أنت متأكد من حذف هذا الصنف !!</h5>
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
        var categoryTable = $('.category-table').DataTable({
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
            ajax: "{{route("category.activity.index")}}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex' ,orderable: false, searchable: false},
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                    orderable: false,
                    searchable: false
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

        $('body').on('click', '.deleteCategory', function(ee) {
            ee.preventDefault();
            var id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#delete').click(function(e) {
                e.preventDefault();
                $.ajax({

                    url: '/admin/category/' + id,
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
                            categoryTable.draw();
                        }

                    }

                });
            });

            $('#cancel').click(function() {
                $('#delete-modal').modal('hide');
            });
        });





    });
</script>
@endsection
