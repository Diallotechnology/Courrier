<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\Nature;
use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use App\Models\Departement;
use App\Enum\ImputationEnum;
use Livewire\WithPagination;
use App\Models\Correspondant;
use App\Models\Depart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
    public string $create = '';
    public string $fin = '';


    public function ResetFilter(): void
    {
        $this->reset('privacy','priority','nature','date', 'expediteur','etat','model','create','fin');
        $this->resetPage();

    }

    public function render()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $rows = new Paginator(new Collection(), null, null);
        $correspondantQuery = Correspondant::query()->orderBy('nom');
        $typeQuery = Nature::query()->orderBy('nom');

        if ($this->model === "Arrive") {
            $rows = Courrier::with('user', 'nature', 'correspondant')
                ->when(!$isSuperadmin, fn($query) => $query->ByStructure())
                ->when($this->privacy, fn($query) => $query->where('confidentiel', $this->privacy))
                ->when($this->priority, fn($query) => $query->where('priorite', $this->priority))
                ->when($this->nature, fn($query) => $query->where('nature_id', $this->nature))
                ->when($this->expediteur, fn($query) => $query->where('correspondant_id', $this->expediteur))
                ->when($this->date, fn($query) => $query->where('date', $this->date))
                ->when($this->etat, fn($query) => $query->where('etat', $this->etat))
                ->when($this->create, function ($query) {
                    $query->whereDate('created_at', '=', $this->create);
                })->latest()->paginate(15);
        }

        if ($this->model === "Depart") {
            $rows = Depart::with('user', 'nature', 'correspondant')
                ->when(!$isSuperadmin, fn($query) => $query->ByStructure())
                ->when($this->privacy, fn($query) => $query->where('confidentiel', $this->privacy))
                ->when($this->priority, fn($query) => $query->where('priorite', $this->priority))
                ->when($this->nature, fn($query) => $query->where('nature_id', $this->nature))
                ->when($this->expediteur, fn($query) => $query->where('correspondant_id', $this->expediteur))
                ->when($this->date, fn($query) => $query->where('date', $this->date))
                ->when($this->etat, fn($query) => $query->where('etat', $this->etat))
                ->when($this->create, function ($query) {
                    $query->whereDate('created_at', '=', $this->create);
                })->latest()->paginate(15);
        }

        $correspondant = $correspondantQuery->when(!$isSuperadmin, fn($query) => $query->ByStructure())->get();
        $type = $typeQuery->when(!$isSuperadmin, fn($query) => $query->ByStructure())->get();

        return view('livewire.advandced-search', compact('correspondant', 'type', 'rows'));
    }

}
