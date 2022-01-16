<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model{

    use HasFactory;

    protected $fillable = ['title','content','slug','user_id'];
    static $rules = [
        'title'=> 'required|unique:news',
        'content'=> 'required',
    ];

    static $messages = [
        'title.required'=>'العنوان مطلوب',
        'content.required'=>'المحتوى مطلوب',
        'image.required'=>'الصورة مطلوبة',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function slider(){
        return $this->morphOne(Slider::class,'sliderable');
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected $appends=['image_path'];
    public function getImagePathAttribute(){
        return asset('/public/uploads/image_news/'.$this->image->name);
    }

}
