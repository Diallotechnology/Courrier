<?php

namespace App\Exports;

use App\Models\Depart;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DepartExport implements FromQuery, Responsable, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();

        return Depart::query()->when(! $isSuperadmin, fn ($query) => $query->ByStructure());
    }

    public function failed()
    {
        return toastr()->error('Exportation à echoué!');
    }

    /**
     * @var Courrier
     */
    public function map($data): array
    {
        $correspondents = $data->correspondants->pluck('nom')->implode(', ');

        return [
            $data->id,
            $data->user->name,
            $data->user->email,
            $data->numero,
            $data->date_format,
            $data->nature_view(),
            $correspondents,
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
            'Numero de depart',
            'Date de depart',
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
