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
                <li class="breadcrumb-item active">اهتمامات نماذج التسجيل
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
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                      <a href="{{route('registration.form.interest.create')}}" class="btn btn-primary btn-sm " id="add-new"><i class="ft-plus white"></i>اضافة  اهتمام جديد</a>
                    </div>
                  </div>
        </div>
                <div class="card-content collapse show" id="viewNews">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table news-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>الاعدادات </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($registerFormInterest as $value)

                                                <tr id="tr_{{$value->id}}">
                                                        <td>{{$value->id}}</td>
                                                        <td>{{$value->name}}</td>
                                                        <td>
                                                            <span class="dropdown">
                                                              <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                                              <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                                                                <a href="{{route('registration.form.interest.edit',$value->id)}}" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                                                                <a href="#" data-id="{{$value->id}}" class="dropdown-item deleteActivity"><i class="ft-trash-2"></i> حذف</a>
                                                                <a href="{{route('registration.form.interest.showForms',$value->id)}}"  class="dropdown-item '.$classSlider.'"><i class="ft-plus-2"></i>عرض النماذج</a>

                                                                </span>
                                                            </span>
                                                        </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
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
                        <h5>هل أنت متأكد من الحذف  !!</h5>
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
                'pagingType': 'full_numbers',
                'lengthMenu': [
                    [6, 10, 20, 30, 40, -1],
                    [6, 10, 20, 30, 40, 'الكل']
                ],
            });





            //Delete

            $('body').on('click', '.deleteActivity', function (ee) {
                            ee.preventDefault();
                            var id = $(this).data('id');
                            $('#delete-modal').modal('show');
                            $('#delete').click(function (e) {
                                e.preventDefault();
                                $.ajax({

                                    url: '/kwarterz-portal/admin/registration-form-interest/'+id,
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
                                          $('#tr_'+id).remove();
                                        }

                                    }

                                });
                            });

                            $('#cancel').click(function () {
                                $('#delete-modal').modal('hide');
                            });
            });






        });
    </script>
@endsection
