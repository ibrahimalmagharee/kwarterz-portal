<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterFormInterestUser extends Model{

    protected $table = 'register_form_interest_users';

    protected $fillable = ['interest_id', 'register_form_id'];

    public function interest(){
        return $this->belongsTo(RegisterFormInterest::class, 'interest_id');
    }

    public function register_form(){
        return $this->belongsTo(RegistrationForm::class, 'register_form_id');
    }
}
