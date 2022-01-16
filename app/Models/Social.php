<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = ['title','content'];
    static $rules = [
        'link'=> 'required',
        'name'=> 'required',
    ];

    static $messages = [
        'link.required'=>'العنوان مطلوب',
        'name.required'=>'المحتوى مطلوب',
    ];

}
