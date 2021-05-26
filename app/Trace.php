<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    public function info()
    {
        return $this->morphMany(ModelInfo::class, 'model');
    }
}
