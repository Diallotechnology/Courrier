<?php

namespace App\Http\Livewire;

use App\Helper\WithFilter;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Nature;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdvandcedSearch extends Component
{
    use WithPagination, WithFilter;

    public string $reference = '';

    public string $numero = '';

    public string $model = '';

    public string $create = '';

    public string $fin = '';

    public function ResetFilter(): void
    {
        $this->reset('privacy', 'priority', 'nature', 'date', 'expediteur', 'etat', 'model', 'create', 'fin');
        $this->resetPage();

    }

    public function render(): View
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $rows = new Paginator(new Collection(), null, null);

        if ($this->model === 'Arrive') {
            $rows = Courrier::with('user', 'nature', 'correspondant')
                ->when(! $isSuperadmin, fn ($query) => $query->ByStructure())
                ->when($this->reference, fn ($query) => $query->where('reference', $this->reference))
                ->when($this->numero, fn ($query) => $query->where('numero', $this->numero))
                ->when($this->privacy, fn ($query) => $query->where('confidentiel', $this->privacy))
                ->when($this->priority, fn ($query) => $query->where('priorite', $this->priority))
                ->when($this->nature, fn ($query) => $query->where('nature_id', $this->nature))
                ->when($this->expediteur, fn ($query) => $query->where('correspondant_id', $this->expediteur))
                ->when($this->date, fn ($query) => $query->where('date', $this->date))
                ->when($this->etat, fn ($query) => $query->where('etat', $this->etat))
                ->when($this->create, function ($query) {
                    $query->whereDate('created_at', '=', $this->create);
                })->latest()->paginate(15);
        }

        if ($this->model === 'Depart') {
            $rows = Depart::with('user', 'nature', 'correspondants')
                ->when(! $isSuperadmin, fn ($query) => $query->ByStructure())
                ->when($this->numero, fn ($query) => $query->where('numero', $this->numero))
                ->when($this->privacy, fn ($query) => $query->where('confidentiel', $this->privacy))
                ->when($this->priority, fn ($query) => $query->where('priorite', $this->priority))
                ->when($this->nature, fn ($query) => $query->where('nature_id', $this->nature))
                ->when($this->expediteur, fn ($query) => $query->whereRelation('correspondants','id', $this->expediteur))
                ->when($this->date, fn ($query) => $query->where('date', $this->date))
                ->when($this->etat, fn ($query) => $query->where('etat', $this->etat))
                ->when($this->create, function ($query) {
                    $query->whereDate('created_at', '=', $this->create);
                })->latest()->paginate(15);
        }
        $correspondant = Correspondant::orderBy('nom')->when(! $isSuperadmin, fn ($query) => $query->ByStructure())->get();
        $type = Nature::orderBy('nom')->when(! $isSuperadmin, fn ($query) => $query->ByStructure())->get();

        return view('livewire.advandced-search', compact('correspondant', 'type', 'rows'));
    }
}
