<?php

namespace App\Exports;

use App\Farmer;
use App\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;

class FarmersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Loan::all();
    }
}
