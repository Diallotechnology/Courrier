<?php

namespace App\Exports;

use App\Models\Imputation;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImputationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Imputation::all();
    }
}
