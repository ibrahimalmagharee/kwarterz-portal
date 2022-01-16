<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>لوحة التحكم | كوارتز</title>
  <link rel="apple-touch-icon" href="{{asset('/public/web/images/index/logo-title.png')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('/public/web/images/index/logo-title.png')}}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/css-rtl/vendors.css')}}">
  <!-- END VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/vendors/css/forms/selects/select2.min.css')}}">
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/css-rtl/app.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/css-rtl/custom-rtl.css')}}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
  <!-- END Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/css-rtl/plugins/file-uploaders/dropzone.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/app-assets/fonts/simple-line-icons/style.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/assets/css/style-rtl.css')}}">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('/public/front/css/custom.css')}}">
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('/public/admin/css/custom.css')}}"> --}}

  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->
    @include('admin.includes.nav')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('admin.includes.sidebar')
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        @yield('content')
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('admin.includes.footer')

  <!-- BEGIN VENDOR JS-->
  <script src="{{asset('/public/admin/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/vendors/js/editors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/vendors/js/extensions/dropzone.min.js')}}" type="text/javascript"></script>

  <script src="{{asset('/public/admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"
  type="text/javascript"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script src="{{asset('/public/admin/app-assets/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->

  <!-- BEGIN MODERN JS-->
  <script src="{{asset('/public/admin/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/js/core/app.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>

  <script src="{{asset('/public/admin/js/toastr.min.js')}}" type="text/javascript"></script>

  <script src="{{asset('/public/admin/app-assets/js/scripts/tables/datatables/datatable-advanced.js')}}"

  type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>
  <!-- <script src="{{asset('/public/admin/app-assets/js/scripts/editors/editor-ckeditor.js')}}" type="text/javascript"></script>
  <script src="{{asset('/public/admin/app-assets/js/scripts/pages/dashboard-crypto.js')}}" type="text/javascript"></script> -->
  <!-- <script src="{{asset('/public/admin/app-assets/js/ckeditor.js')}}"></script> -->

  @yield('script')

  <!-- END PAGE LEVEL JS-->
  <script type="text/javascript">
        @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"


    switch(type){
        case 'info':
            toastr.info("{{Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{Session::get('message') }}");
            break;
    }
    @endif
</script>

</body>
</html>
