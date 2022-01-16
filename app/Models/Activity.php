<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle','description','date','category_id','slug','user_id'];
    static $rules = [
        'title'=> 'required',
        'subtitle'=> 'required',
        'description'=> 'required',
        'date'=> 'required',
        'category_id'=> 'required',
    ];

    static $messages = [
        'title.required'=>'العنوان مطلوب',
        'subtitle.required'=>'العنوان الفرعي مطلوب',
        'description.required'=>'الوصف مطلوب',
        'date.required'=>'التاريخ مطلوب',
        'image.required'=>'الصورة مطلوبة',
        'category_id.required'=>'الصنف مطلوب مطلوبة',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public function slider(){
        return $this->morphOne(Slider::class,'sliderable');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    protected $appends=['image_path'];
    public function getImagePathAttribute(){
        return asset('/public/uploads/image_activity/'.$this->image->name);
    }
}
