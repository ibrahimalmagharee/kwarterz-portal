@extends('layouts.admin')

@section('content')
<div class="content-body mt-2">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('admin.index')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                        <!-- <i class="icon-pencil info font-large-2 float-left"></i> -->
                        <img src="{{asset('/public/uploads/dashboard/admin.jpg')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$admin_count}}</h3>
                        <span>المشرفين</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('client.index')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                      <img src="{{asset('/public/uploads/dashboard/admin.jpg')}}"  width="50px" />
                        <!-- <i class="icon-pencil info font-large-2 float-left"></i> -->
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$client_count}}</h3>
                        <span>العملاء</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('news.index')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                        <i class="icon-pencil info font-large-2 float-left"></i>
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$news_count}}</h3>
                        <span>الأخبار</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('activity.index')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                        <!-- <i class="icon-pencil info font-large-2 float-left"></i> -->
                        <img src="{{asset('/public/uploads/dashboard/activity.png')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$activity_count}}</h3>
                        <span>الأنشطة</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                </a>
            </div>



          </div>
          <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('course.index')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                      <img src="{{asset('/public/uploads/dashboard/course.png')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$course_count}}</h3>
                        <span>الدورات</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('course.sales')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                      <img src="{{asset('/public/admin/sales.jpg')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$sales_count}}</h3>
                        <span>الكورسات التي تم شراؤها</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                </a>
            </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('company.index')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                      <img src="{{asset('/public/uploads/dashboard/company.jpg')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$company_count }}</h3>
                        <span>الشركات</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('category.activity.index')}}">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                      <img src="{{asset('/public/uploads/dashboard/category.png')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{ $category_activity_count}}</h3>
                        <span>تصنيفات الأنشطة</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            </div>
            



          </div>
          <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
              <div class="card">
              <a href="{{route('category.course.index')}}">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                         <img src="{{asset('/public/uploads/dashboard/category.png')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$category_course_count}}</h3>
                        <span>تصنيف الدورات</span>
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          <div class="col-xl-3 col-lg-6 col-12">
              <div class="card">
                  <a href="{{route('concat.index')}}">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="align-self-center">
                      <img src="{{asset('/public/uploads/dashboard/contact.png')}}"  width="50px" />
                      </div>
                      <div class="media-body text-right">
                        <h3>{{$about_count}}</h3>
                        <span>التواصل </span>
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>

            </div>

@endsection

