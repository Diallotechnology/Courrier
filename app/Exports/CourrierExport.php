<?php

namespace App\Exports;

use Throwable;
use App\Models\Courrier;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CourrierExport implements FromQuery, Responsable, WithMapping, WithHeadings
{
    use Exportable;
    public array $id = [];
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'courrier_arriver.xlsx';

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
        return toastr()->error('Exportation à echoué!');
    }


    public function query()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        return Courrier::query()->when(! $isSuperadmin, fn ($query) => $query->ByStructure());
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
            $data->reference,
            $data->numero,
            $data->date_format,
            $data->nature_view(),
            $data->correspondant_view(),
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
            'Reference',
            'Numero arrivé',
            'Date arrivé',
            'Nature',
            'Correspondant',
            'Priorité',
            'Confidentiel',
            'Objet',
            'Etat',
            'Date de creation',
        ];
    }




}
