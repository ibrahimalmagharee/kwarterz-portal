<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterFormInterest extends Model{

    protected $table = 'registration_form_interests';

    protected $fillable = ['name'];

    public function users(){
        return $this->hasMany(RegisterFormInterestUser::class, 'interest_id');
    }
      public function forms(){
          return $this->belongsToMany(RegistrationForm::class,'register_form_interest_users','interest_id','register_form_id');
      }
}
