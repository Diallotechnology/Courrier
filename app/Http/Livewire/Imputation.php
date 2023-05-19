<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Courrier;
use App\Models\Departement;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
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
        $this->reset('delai','priority','fin','courrier', 'departement','etat','fin');
        $this->resetPage();
    }

    public function render()
    {
        if ($this->delai || $this->priority  || $this->courrier || $this->etat || $this->departement || $this->fin) {
            $rows = ModelsImputation::with('user','departement','courrier')
            ->when($this->priority && !empty($this->priority), function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->delai && !empty($this->delai), function ($query) {
                $query->where('delai', $this->delai);
            })
            ->when($this->fin && !empty($this->fin), function ($query) {
                $query->where('fin_traitement', $this->fin);
            })
            ->when($this->departement && !empty($this->departement), function ($query) {
                $query->where('departement_id', $this->departement);
            })
            ->when($this->courrier && !empty($this->courrier), function ($query) {
                $query->where('courrier_id', $this->courrier);
            })
            ->when($this->etat && !empty($this->etat), function ($query) {
                $query->where('etat', $this->etat);
            })->latest()->paginate(15);
        } else {
            $rows = ModelsImputation::with('user','departement','courrier')->latest()->paginate(15);
            // $rows = DB::table('imputations')->select('imputations.*')->groupBy('reference')->paginate(15);
            // \dd($rows);
        }

        $arriver = Courrier::with('nature')->latest()->get(['id','numero','reference','date']);
        $division = Departement::all();
        return view('livewire.imputation', compact('rows','arriver','division'));
    }
}
