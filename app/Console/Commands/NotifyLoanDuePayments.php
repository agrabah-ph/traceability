<?php

namespace App\Console\Commands;

use App\Loan;
use App\LoanPaymentSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyLoanDuePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:loan_due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification for loan due dates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        return 0;
        $loans = Loan::where('status', 'active')->get();
        foreach ($loans as $loan){
            if($loan->notify === 1){
                smsNotification('loan-due', $loan->id);
            }
        }

    }
}
