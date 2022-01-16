<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends=['image_path'];
    public function getImagePathAttribute(){
        return asset('/public/uploads/main-slider/'.$this->image);
    }
}
