<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    protected $appends=['image_path'];
    public function getImagePathAttribute(){
        return asset('/public/uploads/image_company/'.$this->image->name);
    }
}
