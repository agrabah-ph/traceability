<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterFarmer extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
