<?php

namespace App\Exports;

use App\Models\Depart;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DepartExport implements FromQuery, Responsable, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'courrier_depart.xlsx';

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
        return Depart::query()->when(! $isSuperadmin, fn ($query) => $query->ByStructure());
    }

    /**
    * @var Courrier $data
    */
    public function map($data): array
    {
        return [
            $data->id,
            $data->user->name,
            $data->user->email,
            $data->numero,
            $data->date_format,
            $data->nature_view(),
            // $data->correspondant_view(),
            $data->priorite,
            $data->confidentiel,
            $data->objet,
            $data->etat->value,
            $data->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Utilisateur',
            'email',
            'Numero de depart',
            'Date de depart',
            'Nature',
            // 'Correspondant',
            'Priorité',
            'Confidentiel',
            'Objet',
            'Etat',
            'Date de creation',
        ];
    }
}
