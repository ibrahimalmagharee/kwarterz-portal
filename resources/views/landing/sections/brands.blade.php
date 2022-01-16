<div class="brand-wrapper pt-5 pb-7">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-slider owl-carousel owl-theme overflow-visible dot-none">
                    @foreach ($companies as $campany)
                        <div class="owl-items text-center"><img src="{{$campany->image_path}}" alt="icon" class="w100 ml-auto mr-auto"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
