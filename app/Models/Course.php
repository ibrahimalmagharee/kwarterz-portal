<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model{
    use HasFactory;
    protected $fillable = ['title','description','benefit','short_description','hours','price','category_id','slug','user_id'];
    static $rules = [
        'title'=> 'required',
        'description'=> 'required',
        'hours'=> 'required',
        'price'=> 'required',
        'category_id'=> 'required',
    ];

    static $messages = [
        'title.required'=>'يرجى عليك إضافة اسم الدورة',
        'description.required'=>'يرجى عليك إضافة وصف الدورة',
        'hours.required'=>'يرجى عليك إضافة عدد ساعات الدورة',
        'price.required'=>'يرجى عليك إضافة سعر الدورة',
        'category_id.required'=>'يجب عليك إضافة تصنيف للدورة',
        'image.required'=>'يجب عليك إضافة صورة الدورة',

    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function lessons_number(){
        $no_lessons = 0;

        foreach($this->sections as $section){
            foreach($section->lectures as $lesson){
                $no_lessons++;
            }
        }

        return $no_lessons;
    }

    public function students_number(){
       return Purchase::where('course_id', $this->id)->count();
    }

    public function is_saved($user_id){
        $is_found = SaveCourse::where('course_id', $this->id)->where('user_id', $user_id)->count();
        if($is_found){
            return true;
        }else{
            return false;
        }
    }

    public function is_purchased($user_id){
        $is_found = Purchase::where('course_id', $this->id)->where('user_id', $user_id)->where('approved_payment', '!=', null)->count();
        if($is_found){
            return true;
        }else{
            return false;
        }
    }

    public function slider(){
        return $this->morphOne(Slider::class,'sliderable');
    }
    protected $appends=['image_path'];

    public function getImagePathAttribute(){
        return asset('/public/uploads/image_course/'.$this->image->name);
    }
}
