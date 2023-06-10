<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use App\Models\Departement;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Imputation as ModelsImputation;

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
        $this->reset('delai','priority','fin','courrier', 'departement','etat');
        $this->resetPage();
    }

    public function render()
    {

        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = ModelsImputation::with('user','departement','courrier')
            ->when(!$isSuperadmin, fn($query) => $query->ByStructure())
            ->when($this->priority, function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->delai, function ($query) {
                $query->where('delai', $this->delai);
            })
            ->when($this->fin, function ($query) {
                $query->where('fin_traitement', $this->fin);
            })
            ->when($this->departement, function ($query) {
                $query->where('departement_id', $this->departement);
            })
            ->when($this->courrier, function ($query) {
                $query->where('courrier_id', $this->courrier);
            })
            ->when($this->etat, function ($query) {
                $query->where('etat', $this->etat);
            });
        $rows = $query->latest()->paginate(15);

        $arriver = Courrier::where('etat','!=',CourrierEnum::ARCHIVE)
        ->when(!$isSuperadmin, fn($query) => $query->ByStructure())->latest()->get(['id','numero','date']);
        $division = Departement::when(!$isSuperadmin, fn($query) => $query->ByStructure())->get();
        return view('livewire.imputation', compact('rows','arriver','division'));
    }
}
