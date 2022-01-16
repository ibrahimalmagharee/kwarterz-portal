<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name','course_id','slug'];
    static $rules = [
        'name'=> 'required',
    ];

    static $messages = [
        'name.required'=>'الاسم مطلوب',
    ];
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function lectures(){
        return $this->hasMany(Lecture::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
