<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RegistrationFormInterest;
use App\Http\Controllers\User\HomeController;
use App\Models\Concat;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Company;
use App\Models\Course;
use App\Models\News;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//aa
Route::get('/', [App\Http\Controllers\Landing\HomeController::class, 'index'])->name('index');

Route::get('/about', [App\Http\Controllers\Landing\AboutController::class, 'index'])->name('about');

Route::get('/dependence', [App\Http\Controllers\Landing\DependController::class, 'index'])->name('dependence');


Route::get('/contact', [App\Http\Controllers\Landing\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\Landing\ConcatController::class, 'store'])->name('store.contact');

Route::get('/register', [App\Http\Controllers\Landing\HomeController::class, 'register'])->name('register');

Route::get('/login', [App\Http\Controllers\Landing\HomeController::class, 'login'])->name('login');

Route::get('/register-form', [App\Http\Controllers\RegisterFormController::class, 'index'])->name('register-form');
Route::post('/register-form', [App\Http\Controllers\RegisterFormController::class, 'store'])->name('store.register-form');

Route::group(['prefix' => 'activities'], function (){
    Route::get('/', [App\Http\Controllers\Landing\ActivityController::class, 'index'])->name('activities');
    Route::get('show/{activity}', [App\Http\Controllers\Landing\ActivityController::class, 'show'])->name('show.activity');
});

Route::group(['prefix' => 'news'], function (){
    Route::get('/', [App\Http\Controllers\Landing\NewController::class, 'index'])->name('news');
    Route::get('show/{new}', [App\Http\Controllers\Landing\NewController::class, 'show'])->name('show.new');
});

Route::group(['prefix' => 'diplomas'], function (){
    Route::get('/', [App\Http\Controllers\Landing\DiplomaController::class, 'index'])->name('diplomas');
    Route::get('show/{diploma}', [App\Http\Controllers\Landing\DiplomaController::class, 'show'])->name('show.diploma');
});

Route::group(['prefix' => 'courses'], function (){
    Route::get('/', [App\Http\Controllers\Landing\CourseController::class, 'index'])->name('courses');
    Route::get('show/{course}', [App\Http\Controllers\Landing\CourseController::class, 'show'])->name('show.course');
});

Route::group(['prefix' => 'categories'], function (){
    Route::get('show/{category}', [App\Http\Controllers\Landing\CategoryCourseController::class, 'index'])->name('show.categories');
});


Route::post('/user-login', [App\Http\Controllers\Auth\LoginController::class, 'user_login'])->name('user.login');
Route::post('/user-register', [App\Http\Controllers\User\RegisterController::class, 'store'])->name('user.register');

// Route::get('/user-home',function(){
//     return "user home";
// })->name('user.home')->middleware('auth','is_user');

Route::get('/user-home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home')->middleware('auth','is_user');

Route::group(['prefix' => 'settings'], function (){
    Route::get('/', [App\Http\Controllers\User\SettingsController::class, 'index'])->name('user.settings')->middleware('auth','is_user');
    Route::get('/account-information', [App\Http\Controllers\User\SettingsController::class, 'account_information'])->name('user.accountInformation')->middleware('auth','is_user');
    Route::post('/account-information', [App\Http\Controllers\User\SettingsController::class, 'update_information'])->name('user.updateAccountInformation')->middleware('auth','is_user');

    Route::get('/change-password', [App\Http\Controllers\User\SettingsController::class, 'password'])->name('user.password')->middleware('auth','is_user');
    Route::post('/change-password', [App\Http\Controllers\User\SettingsController::class, 'change_password'])->name('user.changePassword')->middleware('auth','is_user');
});

Route::group(['prefix' => 'user-categories'], function (){
    Route::get('show/{category}', [App\Http\Controllers\User\CategoryCourseController::class, 'index'])->name('user.show.categories');
});

Route::group(['prefix' => 'user-courses'], function (){
    Route::get('/', [App\Http\Controllers\User\CourseController::class, 'index'])->name('user.courses');
    Route::get('show/{course}', [App\Http\Controllers\User\CourseController::class, 'show'])->name('user.show.course');
    Route::get('purchase/{course}', [App\Http\Controllers\User\CourseController::class, 'purchase'])->name('user.purchase.course');
});

Route::group(['prefix' => 'user-news'], function (){
    Route::get('/', [App\Http\Controllers\User\NewController::class, 'index'])->name('user.news');
    Route::get('show/{new}', [App\Http\Controllers\User\NewController::class, 'show'])->name('user.show.new');
});

Route::group(['prefix' => 'user-activities'], function (){
    Route::get('/', [App\Http\Controllers\User\ActivityController::class, 'index'])->name('user.activities');
    Route::get('show/{activity}', [App\Http\Controllers\User\ActivityController::class, 'show'])->name('user.show.activity');
});

Route::group(['prefix' => 'user-save-courses'], function (){
    Route::get('/', [App\Http\Controllers\User\SaveCourseController::class, 'index'])->name('user.save.courses');
    Route::post('{course_id}', [App\Http\Controllers\User\SaveCourseController::class, 'store'])->name('user.save.course');
    Route::delete('{course_id}', [App\Http\Controllers\User\SaveCourseController::class, 'destroy'])->name('user.unsave.course');
});

Route::group(['prefix' => 'user-purchase-courses'], function (){
    Route::get('/', [App\Http\Controllers\User\CoursePurchaseController::class, 'index'])->name('user.purchase.courses');
    Route::get('{course_id}', [App\Http\Controllers\User\CoursePurchaseController::class, 'show'])->name('user.show.purchase.course');
});

Route::get('/get-lecture-video/{lecture_id}', [App\Http\Controllers\User\LessonController::class, 'index']);

Route::post('/transaction', [App\Http\Controllers\User\PaymentController::class, 'makePayment'])->name('make-payment');

//Auth::routes();
Auth::routes(['register'=> false,'login' =>false]);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'admin_login'])->name('admin.login');


//admin
Route::get('/admin/login',function(){
    return view('auth.admin.login');
})->name('login.view')->middleware('guest');

Route::group(['prefix' => 'admin'], function (){
    Route::get('/home',function(){
        $project_ids =  Purchase::where('approved_payment','!=',null)->where('refund_payment','=',null)->pluck('course_id')->toArray();
        $sales_count = Course::whereIn('id',$project_ids)->count();
        $admin_count = User::where('is_admin',1)->count();
        $client_count = User::where('is_admin',0)->count();
        $news_count = News::count();
        $activity_count = Activity::count();
        $course_count = Course::count();
        $company_count = Company::count();
        $category_course_count = Category::where('type','course')->count();
        $category_activity_count = Category::where('type','activity')->count();
        $about_count = Concat::count();
        return view('admin.dashboard',compact('sales_count','admin_count','client_count','news_count','activity_count','course_count','company_count','category_course_count','category_activity_count','about_count'));
    })->name('admin.home')->middleware(['auth','is_admin']);

    Route::get('/index', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [App\Http\Controllers\Admin\AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.store');
    Route::get('/{user}/edit', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/{user}/update', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admin.update');
     Route::delete('/{user}/delete', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.destroy');

     Route::group(['prefix' => 'client'], function (){
        Route::get('/index', [App\Http\Controllers\Admin\ClientController::class, 'index'])->name('client.index');
        Route::get('/create', [App\Http\Controllers\Admin\ClientController::class, 'create'])->name('client.create');
        Route::post('/store', [App\Http\Controllers\Admin\ClientController::class, 'store'])->name('client.store');
        Route::get('/{user}/edit', [App\Http\Controllers\Admin\ClientController::class, 'edit'])->name('client.edit');
        Route::post('/{user}/update', [App\Http\Controllers\Admin\ClientController::class, 'update'])->name('client.update');
        Route::delete('/{user}/delete', [App\Http\Controllers\Admin\ClientController::class, 'destroy'])->name('client.destroy');
     });




    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'create'])->name('admin.profile.create');
    Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    //concat
    Route::group(['prefix' => 'concat'], function (){
        Route::get('/', [App\Http\Controllers\Admin\ConcatController::class, 'index'])->name('concat.index');
    });
    //about
    Route::group(['prefix' => 'about'], function (){
        Route::get('/', [App\Http\Controllers\Admin\AboutController::class, 'create'])->name('about.create');
        Route::post('/store', [App\Http\Controllers\Admin\AboutController::class, 'store'])->name('about.store');
    });
    Route::group(['prefix' => 'main-slider'], function (){
        Route::get('/', [App\Http\Controllers\Admin\MainSliderController::class, 'create'])->name('mainSlider.create');
        Route::post('/store', [App\Http\Controllers\Admin\MainSliderController::class, 'store'])->name('mainSlider.store');
    });


    Route::group(['prefix' => 'dependence'], function (){
        Route::get('/', [App\Http\Controllers\Admin\DependenceController::class, 'create'])->name('dependence.create');
        Route::post('/store', [App\Http\Controllers\Admin\DependenceController::class, 'store'])->name('dependence.store');
        Route::post('/uploadImageAjax', [App\Http\Controllers\Admin\DependenceController::class, 'uploadImageAjax'])->name('dependence.uploadImageAjax');
        Route::get('/removeImageAjax', [App\Http\Controllers\Admin\DependenceController::class, 'removeImageAjax'])->name('dependence.removeImageAjax');
        Route::get('/removeImageAjaxDropzone', [App\Http\Controllers\Admin\DependenceController::class, 'removeImageAjaxDropzone'])->name('dependence.removeImageAjaxDropzone');



    });

    //diploma
    Route::group(['prefix' => 'diplomas'], function (){
        Route::post('/make-slider', [App\Http\Controllers\Admin\DiplomaController::class, 'makeSlider'])->name('diploma.makeSlider');
        Route::post('/remove-slider', [App\Http\Controllers\Admin\DiplomaController::class, 'removeSlider'])->name('diploma.removeSlider');

        Route::post('/uploadImageAjax', [App\Http\Controllers\Admin\DiplomaController::class, 'uploadImageAjax'])->name('diploma.uploadImageAjax');
        Route::get('/removeImageAjax', [App\Http\Controllers\Admin\DiplomaController::class, 'removeImageAjax'])->name('diploma.removeImageAjax');
        Route::get('/removeImageAjaxDropzone', [App\Http\Controllers\Admin\DiplomaController::class, 'removeImageAjaxDropzone'])->name('diploma.removeImageAjaxDropzone');
        Route::get('/', [App\Http\Controllers\Admin\DiplomaController::class, 'index'])->name('diploma.index');
        Route::get('/create', [App\Http\Controllers\Admin\DiplomaController::class, 'create'])->name('diploma.create');
        Route::post('/', [App\Http\Controllers\Admin\DiplomaController::class, 'store'])->name('diploma.store');
        Route::post('/{id}', [App\Http\Controllers\Admin\DiplomaController::class, 'update'])->name('diploma.update');
        Route::get('/{diploma}/edit', [App\Http\Controllers\Admin\DiplomaController::class, 'edit'])->name('diploma.edit');
        Route::delete('/', [App\Http\Controllers\Admin\DiplomaController::class, 'destroy'])->name('diploma.destroy');

    });




    //companies
    Route::group(['prefix' => 'company'], function (){
        Route::get('/', [App\Http\Controllers\Admin\CompanyController::class, 'index'])->name('company.index');
        Route::get('/create', [App\Http\Controllers\Admin\CompanyController::class, 'create'])->name('company.create');
        Route::post('/', [App\Http\Controllers\Admin\CompanyController::class, 'store'])->name('company.store');
        Route::get('/{company}/edit', [App\Http\Controllers\Admin\CompanyController::class, 'edit'])->name('company.edit');
        Route::get('/{company}', [App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('company.show');
        Route::post('/{company}', [App\Http\Controllers\Admin\CompanyController::class, 'update'])->name('company.update');
        Route::delete('/{company}', [App\Http\Controllers\Admin\CompanyController::class, 'destroy'])->name('company.destroy');
    });

    //social
    Route::group(['prefix' => 'social-media'], function (){
        Route::get('/', [App\Http\Controllers\Admin\SocialController::class, 'index'])->name('social.index');
        Route::get('/create', [App\Http\Controllers\Admin\SocialController::class, 'create'])->name('social.create');
        Route::post('/', [App\Http\Controllers\Admin\SocialController::class, 'store'])->name('social.store');
        Route::get('/{social}/edit', [App\Http\Controllers\Admin\SocialController::class, 'edit'])->name('social.edit');
        Route::get('/{social}', [App\Http\Controllers\Admin\SocialController::class, 'show'])->name('social.show');
        Route::post('/{social}', [App\Http\Controllers\Admin\SocialController::class, 'update'])->name('social.update');
        Route::delete('/{social}', [App\Http\Controllers\Admin\SocialController::class, 'destroy'])->name('social.destroy');
    });

    //news
    Route::group(['prefix' => 'news'], function (){
        Route::post('/make-slider', [App\Http\Controllers\Admin\NewsController::class, 'makeSlider'])->name('news.makeSlider');
        Route::post('/remove-slider', [App\Http\Controllers\Admin\NewsController::class, 'removeSlider'])->name('news.removeSlider');

        Route::get('/', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news.index');
        Route::get('/create', [App\Http\Controllers\Admin\NewsController::class, 'create'])->name('news.create');
        Route::post('/', [App\Http\Controllers\Admin\NewsController::class, 'store'])->name('news.store');
        Route::get('/{new}/edit', [App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('news.edit');
        Route::get('/{new}', [App\Http\Controllers\Admin\NewsController::class, 'show'])->name('news.show');
        Route::post('/{new}', [App\Http\Controllers\Admin\NewsController::class, 'update'])->name('news.update');
        Route::delete('/{new}', [App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('news.destroy');
    });

    //news
    // Route::group(['prefix' => 'sliders'], function (){
    //     Route::get('/', [App\Http\Controllers\Admin\SliderController::class, 'index'])->name('slider.index');
    //     Route::get('/create', [App\Http\Controllers\Admin\SliderController::class, 'create'])->name('slider.create');
    //     Route::post('/', [App\Http\Controllers\Admin\SliderController::class, 'store'])->name('slider.store');
    //     Route::get('/{slider}/edit', [App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('slider.edit');
    //     Route::get('/{slider}', [App\Http\Controllers\Admin\SliderController::class, 'show'])->name('slider.show');
    //     Route::post('/{slider}', [App\Http\Controllers\Admin\SliderController::class, 'update'])->name('slider.update');
    //     Route::delete('/{slider}', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('slider.destroy');
    // });

    //activity
    Route::group(['prefix' => 'activity'], function (){
        Route::get('/', [App\Http\Controllers\Admin\ActivityController::class, 'index'])->name('activity.index');
        Route::get('/create', [App\Http\Controllers\Admin\ActivityController::class, 'create'])->name('activity.create');
        Route::post('/', [App\Http\Controllers\Admin\ActivityController::class, 'store'])->name('activity.store');
        Route::get('/{activity}/edit', [App\Http\Controllers\Admin\ActivityController::class, 'edit'])->name('activity.edit');
        Route::get('/{activity}', [App\Http\Controllers\Admin\ActivityController::class, 'show'])->name('activity.show');
        Route::get('/{activity}', [App\Http\Controllers\Admin\ActivityController::class, 'destroy'])->name('activity.destroy');
        Route::delete('/{activity}', [App\Http\Controllers\Admin\ActivityController::class, 'destroy'])->name('activity.destroy');
        Route::post('/make-slider', [App\Http\Controllers\Admin\ActivityController::class, 'makeSlider'])->name('activity.makeSlider');
        Route::post('/remove-slider', [App\Http\Controllers\Admin\ActivityController::class, 'removeSlider'])->name('activity.removeSlider');


    });
    //forms

    Route::group(['prefix' => 'registration-form-interest'], function (){
        Route::get('/', [App\Http\Controllers\Admin\RegistrationFormInterest::class, 'index'])->name('registration.form.interest.index');
            Route::get('/create', [App\Http\Controllers\Admin\RegistrationFormInterest::class, 'create'])->name('registration.form.interest.create');
            Route::post('/', [App\Http\Controllers\Admin\RegistrationFormInterest::class, 'store'])->name('registration.form.interest.store');
        Route::get('/{registerFormInterest}/edit', [App\Http\Controllers\Admin\RegistrationFormInterest::class, 'edit'])->name('registration.form.interest.edit');
        Route::get('/{registerFormInterest}', [App\Http\Controllers\Admin\RegistrationFormInterest::class, 'showForms'])->name('registration.form.interest.showForms');
        Route::post('/{registerFormInterest}', [App\Http\Controllers\Admin\RegistrationFormInterest::class, 'update'])->name('registration.form.interest.update');
        Route::delete('/{registerFormInterest}', [App\Http\Controllers\Admin\RegistrationFormInterest::class, 'destroy'])->name('registration.form.interest.delete');

    });

    //category
    Route::group(['prefix' => 'category'], function (){




        //activity
        Route::delete('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.destroy');

        Route::group(['prefix' => 'activity'], function (){
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.activity.index');
            Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.activity.create');
            Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.activity.store');
            Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.activity.edit');
            Route::get('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('category.activity.show');
            Route::post('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.activity.update');
        });

        //course
        Route::group(['prefix' => 'course'], function (){
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.course.index');
            Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.course.create');
            Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.course.store');
            Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.course.edit');
            Route::get('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('category.course.show');
            Route::post('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.course.update');
        });

    });



    Route::get('/course/sales', [App\Http\Controllers\Admin\CourseController::class, 'course_sales'])->name('course.sales');

    //course
    Route::group(['prefix' => 'course'], function (){

        Route::get('/', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('course.index');
        Route::post('/make-slider', [App\Http\Controllers\Admin\CourseController::class, 'makeSlider'])->name('course.makeSlider');
        Route::post('/remove-slider', [App\Http\Controllers\Admin\CourseController::class, 'removeSlider'])->name('course.removeSlider');
            Route::get('/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('course.create');
            Route::post('/', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('course.store');
            Route::get('/{course}/edit', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('course.edit');
            Route::get('/{course}', [App\Http\Controllers\Admin\CourseController::class, 'show'])->name('course.show');
            Route::post('/{course}', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('course.update');
            Route::delete('/{course}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('course.destroy');
            Route::get('/fetch_course_sales', [App\Http\Controllers\Admin\CourseController::class, 'fetch_course_sales'])->name('fetch.course.sales');

            //section

        Route::group(['prefix' => '{course}/section'], function (){
            Route::get('/', [App\Http\Controllers\Admin\SectionController::class, 'index'])->name('section.index');
            Route::get('/create', [App\Http\Controllers\Admin\SectionController::class, 'create'])->name('section.create');
            Route::post('/', [App\Http\Controllers\Admin\SectionController::class, 'store'])->name('section.store');
            Route::get('/{section}/edit', [App\Http\Controllers\Admin\SectionController::class, 'edit'])->name('section.edit');
            Route::get('/{section}', [App\Http\Controllers\Admin\SectionController::class, 'show'])->name('section.show');
            Route::post('/{section}', [App\Http\Controllers\Admin\SectionController::class, 'update'])->name('section.update');
            Route::delete('/{section}', [App\Http\Controllers\Admin\SectionController::class, 'destroy'])->name('section.destroy');
        });

         //lessons

    Route::group(['prefix' => '{course}/lesson'], function (){
        Route::get('/', [App\Http\Controllers\Admin\LectureController::class, 'index'])->name('lesson.index');
        Route::get('/create', [App\Http\Controllers\Admin\LectureController::class, 'create'])->name('lesson.create');
        Route::post('/', [App\Http\Controllers\Admin\LectureController::class, 'store'])->name('lesson.store');
        Route::get('/{lecture}/edit', [App\Http\Controllers\Admin\LectureController::class, 'edit'])->name('lesson.edit');
        Route::get('/{lecture}/show', [App\Http\Controllers\Admin\LectureController::class, 'show'])->name('lesson.show');
        Route::post('/{lecture}', [App\Http\Controllers\Admin\LectureController::class, 'update'])->name('lesson.update');
        Route::delete('/{lecture}', [App\Http\Controllers\Admin\LectureController::class, 'destroy'])->name('lesson.destroy');
    });

    });

    Route::group(['prefix' => 'activity'], function (){
        Route::get('/', [App\Http\Controllers\Admin\ActivityController::class, 'index'])->name('activity.index');
        Route::get('/create', [App\Http\Controllers\Admin\ActivityController::class, 'create'])->name('activity.create');
        Route::post('/', [App\Http\Controllers\Admin\ActivityController::class, 'store'])->name('activity.store');
        Route::get('/{activity}/edit', [App\Http\Controllers\Admin\ActivityController::class, 'edit'])->name('activity.edit');
        Route::get('/{activity}', [App\Http\Controllers\Admin\ActivityController::class, 'show'])->name('activity.show');
        Route::post('/{activity}', [App\Http\Controllers\Admin\ActivityController::class, 'update'])->name('activity.update');
        Route::delete('/{activity}', [App\Http\Controllers\Admin\ActivityController::class, 'destroy'])->name('activity.destroy');
    });

});


