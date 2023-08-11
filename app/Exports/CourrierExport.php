<?php

namespace App\Exports;

use App\Helper\WithExportAction;
use App\Models\Courrier;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class CourrierExport implements FromQuery, Responsable, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        return Courrier::query()->when(!$isSuperadmin, fn ($query) => $query->ByStructure());
    }

    /**
     * @var Courrier
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
            $data->etat,
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
