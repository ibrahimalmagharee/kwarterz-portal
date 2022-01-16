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
                        <li class="breadcrumb-item active">تواصل معنا
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
                                <h4 class="card-title">كل الرسائل   </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                <!-- <div class="heading-elements">
                                    <a href="/admin/social/create" class="btn btn-primary btn-sm " id="add-social"><i class="ft-plus white"></i>اضافة شركة جديدة </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-content collapse show" id="viewCategory">
                            <div class="card-body card-dashboard table-responsive">
                                <table class="table aboutUs-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>الرسالة</th>
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
           var companyTable = $('.aboutUs-table').DataTable({
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
            ajax: "{{route("concat.index")}}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'message',
                    name: 'message'
                },
            ]
        });


    });
</script>
@endsection
