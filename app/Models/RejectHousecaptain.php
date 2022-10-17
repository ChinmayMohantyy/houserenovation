<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RejectHousecaptain extends Model
{
    public function housecaptain()
    {
       return $this->hasone('App\Models\HouseCaptain','id','rejected_housecaptain_id');

    }
}
