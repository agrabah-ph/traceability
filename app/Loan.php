<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    public function borrower()
    {
        return $this->morphTo()->with('profile');
    }

    public function product()
    {
        return $this->belongsTo(LoanProduct::class, 'loan_product_id')->with('type');
    }

    public function provider()
    {
        return $this->belongsTo(LoanProvider::class, 'loan_provider_id')->with('profile');
    }

    public function payment_schedules()
    {
        return $this->hasMany(LoanPaymentSchedule::class, 'loan_id');
    }
}
