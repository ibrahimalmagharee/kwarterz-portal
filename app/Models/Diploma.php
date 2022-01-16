<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;
    protected $guarded = [];
    static $rules = [
        'title'=> 'required',
        'description'=> 'required',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }
    public function slider(){
        return $this->morphOne(Slider::class,'sliderable');
    }

    protected $appends=['image_path'];

    public function getImagePathAttribute(){
        return asset('/public/uploads/diplomas/'.$this->images[0]->name);
    }
}
