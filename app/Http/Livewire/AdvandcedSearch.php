<?php

namespace App\Http\Livewire;

use App\Enum\CourrierEnum;
use App\Enum\ImputationEnum;
use App\Models\Task;
use App\Models\Nature;
use Livewire\Component;
use App\Models\Courrier;
use App\Models\Departement;
use Livewire\WithPagination;
use App\Models\Correspondant;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class AdvandcedSearch extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $privacy = '';
    public string $priority = '';
    public string $nature = '';
    public string $date = '';
    public string $expediteur = '';
    public string $etat = '';
    public string $model = '';
    public $selectedDate;
    // imputation attribut
    public string $departement = '';
    public string $delai = '';
    public string $fin = '';
    public string $arriver = '';
    public bool $show = false;

    protected $listeners = ['updated:selectedDate' => 'handleSelectedDateUpdate'];

    public function handleSelectedDateUpdate($value)
    {
        $this->selectedDate = $value;
    }

    public function queryfilter()
    {

    }

    public function render()
    {

        $statut = null;
        $rows = new Paginator(new Collection(), null, null);
        $correspondant = Correspondant::orderBy('nom')->get();
        $type = Nature::orderBy('nom')->get();
        $division = Departement::all();
        $courrier = Courrier::latest()->get(['id', 'numero', 'reference', 'date']);

        if ($this->model === "Arrive" || $this->model === "Depart") {
            $statut = CourrierEnum::cases();

            if ($this->privacy || $this->priority || $this->nature || $this->date || $this->etat || $this->expediteur) {
                $rows = Courrier::with('user', 'nature', 'correspondant')
                    ->when($this->privacy && !empty($this->privacy), function ($query) {
                        $query->where('confidentiel', $this->privacy);
                    })
                    ->when($this->priority && !empty($this->priority), function ($query) {
                        $query->where('priorite', $this->priority);
                    })
                    ->when($this->nature && !empty($this->nature), function ($query) {
                        $query->where('nature_id', $this->nature);
                    })
                    ->when($this->expediteur && !empty($this->expediteur), function ($query) {
                        $query->where('correspondant_id', $this->expediteur);
                    })
                    ->when($this->date && !empty($this->date), function ($query) {
                        $query->where('date', $this->date);
                    })
                    ->when($this->etat && !empty($this->etat), function ($query) {
                        $query->where('etat', $this->etat);
                    })->latest()->paginate(15);
            }
        }

        if ($this->model === "Imputation") {
            $this->show = true;
            $statut = ImputationEnum::cases();

            if ($this->delai || $this->priority || $this->arriver || $this->etat || $this->departement || $this->fin) {
                $rows = Imputation::with('user', 'departement', 'courrier')
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
                    ->when($this->arriver && !empty($this->arriver), function ($query) {
                        $query->where('courrier_id', $this->arriver);
                    })
                    ->when($this->etat && !empty($this->etat), function ($query) {
                        $query->where('etat', $this->etat);
                    })->latest()->paginate(15);
            }
        }

        if($this->model === "Rapport") {

        }
        return view('livewire.advandced-search',compact('correspondant','type','rows','division','courrier','statut'));
    }
}
