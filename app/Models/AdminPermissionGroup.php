<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermissionGroup extends Model
{
    public function permission()
    {
        return $this->hasMany('Spatie\Permission\Models\Permission','permission_group_id', 'id');
    }
}
