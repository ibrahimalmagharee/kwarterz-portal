<nav class="navigation scroll-bar">
    <div class="container pl-0 pr-0">
        <div class="nav-content">
            <div class="nav-top">
                <a href="{{route('user.home')}}"><span class="text-center" style="margin-top:27%"><img style="width: 80%" src="{{asset('/public/web/images/index/logo-title.png')}}" alt=""></span></a>
                <a href="#" class="close-nav d-inline-block d-lg-none"><i class="ti-close bg-grey mb-4 btn-round-sm font-xssss fw-700 text-dark ml-auto mr-2 "></i></a>
            </div>
            <ul class="mb-3 mt-5">
                <li class="logo d-none d-xl-block d-lg-block"></li>
                <li><a href="{{route('user.home')}}" class="nav-content-bttn open-font" data-tab="favorites"><span>الصفحة الرئيسية</span></a></li>
                <li><a href="{{route('user.courses')}}" class="nav-content-bttn open-font" data-tab="favorites"><span>جميع الدورات</span></a></li>
                <li><a href="{{route('user.purchase.courses')}}" class="nav-content-bttn open-font" data-tab="chats"><span>دوراتي</span></a></li>
                <li><a href="{{route('user.save.courses')}}" class="nav-content-bttn open-font" data-tab="friends"><span>الدورات المحفوظة</span></a></li>
                <li><a href="#" class="nav-content-bttn open-font" data-tab="favorites"><span>الدبلومات</span></a></li>
                <li><a href="{{route('user.activities')}}" class="nav-content-bttn open-font" data-tab="favorites"><span>الأنشطة</span></a></li>
                <li><a href="{{route('user.news')}}" class="nav-content-bttn open-font" data-tab="favorites"><span>الأخبار</span></a></li>
            </ul>

            <div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> الحساب</div>
            <ul class="mb-3">
                <li class="logo d-none d-xl-block d-lg-block"></li>
                <li><a href="{{route('user.settings')}}" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i class="font-sm feather-settings ml-3 text-grey-500"></i><span>إعدادات الحساب</span></a></li>
            </ul>
        </div>
    </div>
</nav>
