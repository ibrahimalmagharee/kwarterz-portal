<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','lecture','section_id','slug'];
    static $rules = [
        'title'=> 'required',
        'description'=> 'required',
    ];

    static $messages = [
        'title.required'=>'العنوان مطلوب',
        'description.required'=>'الوصف مطلوب',
        'lecture.required'=>'الفيديو مطلوب',
    ];
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $appends=['video_path'];
    public function getVideoPathAttribute(){
        return asset('/public/uploads/courses/'.$this->section->course->id.'/section/'.$this->section->id.'/'.$this->lecture);
    }
}
