<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanProvider extends Model
{
    public function profile()
    {
        return $this->morphOne(Profile::class, 'model');
    }

    public function products()
    {

    }
}
