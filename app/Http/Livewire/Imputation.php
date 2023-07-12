<?php

namespace App\Http\Livewire;

use App\Enum\CourrierEnum;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Imputation as ModelsImputation;
use App\Models\SubDepartement;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Imputation extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $priority = '';

    public string $delai = '';

    public string $fin = '';

    public string $courrier = '';

    public string $departement = '';

    public string $etat = '';

    public function ResetFilter(): void
    {
        $this->reset('delai', 'priority', 'fin', 'courrier', 'departement', 'etat');
        $this->resetPage();
    }

    public function render(): View
    {

        $user = Auth::user();
        $query = ModelsImputation::with('user', 'departements', 'subdepartements', 'courrier')
            ->when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->when($this->priority, function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->delai, function ($query) {
                $query->where('delai', $this->delai);
            })
            ->when($this->fin, function ($query) {
                $query->where('fin_traitement', $this->fin);
            })
            ->when($this->courrier, function ($query) {
                $query->where('courrier_id', $this->courrier);
            })
            ->when($this->etat, function ($query) {
                $query->where('etat', $this->etat);
            });
        $rows = $query->latest('id')->paginate(15);
        $arriver = Courrier::whereNot('etat', CourrierEnum::ARCHIVE)
            ->when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure())->latest('numero')->get(['id', 'numero', 'date']);
        $id = $user->departements->where('pivot.type', 'division')->pluck('id')->toArray();
        $subid = $user->departements->where('pivot.type', 'sub_division')->pluck('id')->toArray();
        $divisionQuery = Departement::query();
        $sub_divisionQuery = SubDepartement::query();

        if (! empty($id)) {
            $divisionQuery->whereIn('id', $id);
        } elseif (! $user->isSuperadmin()) {
            $divisionQuery->ByStructure();
        }
        $division = $divisionQuery->get();

        if (! empty($subid)) {
            $sub_divisionQuery->whereIn('id', $id);
        } elseif (! $user->isSuperadmin()) {
            $sub_divisionQuery->whereIn('departement_id', $division->pluck('id'));
        }
        $sub_division = $sub_divisionQuery->get();

        return view('livewire.imputation', compact('rows', 'arriver', 'division', 'sub_division'));
    }
}
