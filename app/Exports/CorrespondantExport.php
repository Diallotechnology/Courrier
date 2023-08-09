<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use App\Models\Correspondant;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class CorrespondantExport implements FromQuery, Responsable, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'correspondant.xlsx';

    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;

    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function failed()
    {
        return toastr()->error("L'exportation à echoué!");
    }

    public function query()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        return Correspondant::query()->when(! $isSuperadmin, fn ($query) => $query->ByStructure());
    }

    /**
    * @var Courrier $data
    */
    public function map($data): array
    {
        return [
            $data->id,
            $data->nom,
            $data->fonction,
            $data->email,
            $data->contact,
            $data->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Nom',
            'Fonction',
            'Email',
            'Contact',
            'Date de creation',
        ];
    }
}
