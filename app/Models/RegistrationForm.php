<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationForm extends Model{

    protected $table = 'registration_forms';

    protected $fillable = ['name', 'mobile_number', 'employment', 'country', 'place_of_residence', 'id_number', 'nationality', 'code'];

    public function interests(){
        return $this->hasMany(RegisterFormInterestUser::class, 'register_form_id');
    }
}
