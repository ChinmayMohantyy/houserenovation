<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function house_captain(){
        return $this->hasOne(HouseCaptain::class,'id','recipient_id');
     }
}
