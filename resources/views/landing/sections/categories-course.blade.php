<div class="category-wrapper pb-lg--7 pb-5">
    <div class="container">
        <div class="row">
            <div class="page-title style1 col-xl-4 col-lg-4 col-md-6 text-left">
                <h2 class="text-grey-900 fw-700 display1-size display2-md-size pb-3 mb-0 mt-1 d-block lh-3">تصفح <br>     حسب التصنيف</h2>
                <!-- <p class="fw-300 font-xssss lh-28 text-grey-500">orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dol ad minim veniam, quis nostrud exercitation</p> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-4 ">
                <div class="owl-carousel category-card owl-theme overflow-visible nav-none">
                    @foreach ($categories as $category)
                        <div class="item">
                            <div class="card mr-1 w140 border-0 p-4 rounded-lg text-center" style="background-color: #fcf1eb;">
                                <div class="card-body p-2 ml-1 ">
                                    <a href="{{route('show.categories', $category->id)}}" class="btn-round-xl bg-white"><img src="{{$category->image_path}}" alt="icon" class="p-2"></a>
                                    <h4 class="fw-600 font-xsss mt-3 mb-0">{{$category->name}} <span class="d-block font-xsssss fw-500 text-grey-500 mt-2">{{$category->courses->count()}} دورة</span></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
