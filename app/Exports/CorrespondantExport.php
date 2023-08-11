<?php

namespace App\Exports;

use App\Helper\WithExportAction;
use App\Models\Correspondant;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class CorrespondantExport implements FromQuery, Responsable, WithMapping, WithHeadings
{
    use Exportable;
    public function query()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        return Correspondant::query()->when(! $isSuperadmin, fn ($query) => $query->ByStructure());
    }

    /**
     * @var Courrier
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
