<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $appends = [
        'due_info'
    ];

    public function getDueInfoAttribute()
    {
        $paymentScheds = LoanPaymentSchedule::where('loan_id', $this->attributes['id'])->get();
        $now = Carbon::now();
        $notifyStart = $now->copy()->addDays(72);
        $dueDate = null;
        $payableAmount = 0;
        $paidAmount = 0;
        $notify = 0;

        foreach ($paymentScheds as $sched){
            if( ($sched->status === 'unpaid') && ($sched->due_date > $now) ){
                $dueDate = $sched->due_date;
                $payableAmount += $sched->payable_amount;
                $paidAmount += $sched->paid_amount;
                if ( $dueDate <= $notifyStart ) {
                    $notify = 1;
                }
                break;
            }
        }
        $totalAmount = $payableAmount - $paidAmount;
        $data = [
            'date' => $dueDate,
            'date_diff' => Carbon::parse($dueDate)->diffForHumans(),
            'amount' => number_format($totalAmount, 2),
            'notify_start' => $notifyStart->toDateTimeString(),
            'notify' => $notify
        ];
        return $data;
    }

    public function borrower()
    {
        return $this->morphTo()->with('profile');
    }

    public function details()
    {
        return $this->hasOne(LoanApplicationDetail::class, 'loan_id');
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

    public function payments()
    {
        return $this->hasMany(LoanPayment::class, 'loan_id');
    }


}
