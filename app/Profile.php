<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_id',
        'model_type',
        'first_name',
        'middle_name',
        'last_name',
        'mobile',
        'address',
        'education',
        'four_ps',
        'pwd',
        'indigenous',
        'livelihood',
        'farm_lot',
        'farming_since',
        'organization',
        'status'
    ];

    public function info()
    {
        return $this->morphTo();
    }
}
