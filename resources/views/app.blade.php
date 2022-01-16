<!DOCTYPE html>
<html lang="en" dir="rtl">

@include('landing.layouts.header')

<body class="color-theme-blue mont-font">

    <div class="preloader"></div>
    @yield('content')


    @include('landing.layouts.footer')
    @yield('script')

</body>

</html>
