<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseRepairRequest extends Model
{
    
    public function state_details(){
       return $this->hasOne(State::class,'id','state');
    }
    public function city_details(){
       return $this->hasOne(City::class,'id','city');
    }
    public function field_assistant(){
      return $this->hasOne(Admin::class,'id','field_assistant_id');
    }

    public function house_captain(){
      return $this->hasOne(HouseCaptain::class,'id','house_captain_id');
    }

    public function house_captains()
    {
       return $this->hasone('App\Models\HouseCaptain','id','rejected_house_captains');

    }

    public function rejectHousecaptain()
    {
       return $this->hasone('App\Models\RejectHousecaptain','request_id','id');

    }

    public function accept_admin(){
      return $this->hasOne(Admin::class,'id','user_accept_id');
    }

    public function inventory(){
      return $this->hasMany(InventoryOrder::class,'house_repair_request_id','id');
    }
}
