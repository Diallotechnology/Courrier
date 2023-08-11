<?php

namespace App\Exports;

use App\Models\Depart;
use App\Models\Imputation;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImputationExport implements FromQuery, Responsable, WithMapping, WithHeadings
{

    use Exportable;


    public function query()
    {
        $user = Auth::user();

        return Imputation::query()->with('user')
        ->when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure())
        ->when(! $user->isAdmin(), fn ($query) => $query->where('user_id',$user->id));
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
        return [
            $data->id,
            $data->user->name,
            $data->user->email,
            $data->numero,
            $data->courrier ? $data->courrier->numero : 'inexistant',
            $data->delai_format,
            $data->fin_traitement_format,
            $data->priorite,
            $data->observation,
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
            'Courrier',
            'Delai',
            'Date fin traitement',
            'Priorité',
            'observation',
            'Etat',
            'Date de creation',
        ];
    }
}
