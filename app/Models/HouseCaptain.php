<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HouseCaptain extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name','avatar','email', 'mobile','password','street','city','state','zipcode','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function state_details(){
        return $this->hasOne(State::class,'id','state');
    }
    public function city_details(){
        return $this->hasOne(City::class,'id','city');
    }
}
