<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    public function leader()
    {
        return $this->belongsTo(CommunityLeader::class, 'leader_id');
    }

    public function profile()
    {
        return $this->morphOne(Profile::class, 'model');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'farmer_id');
    }

    public function listing()
    {
        return $this->hasMany(Inventory::class, 'farmer_id')->where('status', 'Accepted');
    }

    public function loans()
    {
        return $this->morphMany(Loan::class, 'borrower');
    }

}
