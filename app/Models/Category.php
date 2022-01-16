<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','type','user_id'];
    static $rules = [
        'name'=> 'required',
    ];

    static $messages = [
        'name.required'=>'الاسم مطلوب',
        'image.required'=>'الصورة مطلوبة',
    ];

    public function courses(){
       $categories_id = $this->where('type', 'course')->pluck('id')->toArray();
        return $this->hasMany(Course::class)->whereIn('category_id',$categories_id);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    protected $appends=['image_path'];
    public function getImagePathAttribute(){
        if($this->type == 'course')
        return asset('/public/uploads/image_category/'.$this->image->name);
        else return;
    }
}
