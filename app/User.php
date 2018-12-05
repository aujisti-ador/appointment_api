<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }


    protected $visible = ['id', 'name', 'email', 'designation', 'mobile_no', 'is_available', 'avatar'];

//    protected $fillable = [
//        'name', 'email', 'password', 'designation', 'mobile_no', 'is_available', 'avatar', 'gender'
//        , 'secret_question', 'secret_answer', 'organizations_id'
//    ];

    protected $guarded = ['password', 'email'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
