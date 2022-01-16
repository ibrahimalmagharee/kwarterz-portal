<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model{
    use HasFactory;
    protected $guarded = [];

    protected $appends=['image_path'];
    public function getImagePathAttribute(){
        return asset('/public/uploads/about/'.$this->image);
    }

}
