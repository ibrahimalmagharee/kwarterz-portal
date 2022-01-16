<div class="header-wrapper pt-3 pb-3 shadow-none pos-fixed position-absolute">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 navbar pt-0 pb-0">
                <a href="{{route('index')}}"><h1 class="fredoka-font ls-3 fw-700 text-current font-xxl">كوارتز <span class="d-block font-xsssss ls-1 text-grey-500 open-font ">للتدريب والاعلام</span></h1></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav nav-menu float-none text-center">
                        <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">اتصل بنا</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('about')}}">من نحن</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('register-form')}}">نموذج التسجيل</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('dependence')}}">اعتماداتنا</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('news')}}">الأخبار</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('activities')}}">الأنشطة</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('diplomas')}}">الدبلومات</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('courses')}}">الدورات</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('index')}}">الصفحة الرئيسية</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 text-right d-lg-block d-none">
                <a href="{{route('login')}}" class="header-btn bg-dark fw-500 text-white font-xssss p-2 lh-32 text-center d-inline-block rounded-xl mt-1">الدخول</a>
                <a href="{{route('register')}}" class="header-btn bg-current fw-500 text-white font-xssss p-2 lh-32 text-center d-inline-block rounded-xl mt-1">التسجيل</a>
            </div>
        </div>
    </div>
</div>
