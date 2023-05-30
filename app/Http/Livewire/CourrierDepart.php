<?php

namespace App\Http\Livewire;

use App\Models\Depart;
use App\Models\Nature;
use Livewire\Component;
use App\Models\Courrier;
use Livewire\WithPagination;
use App\Models\Correspondant;
use Illuminate\Support\Facades\Auth;

class CourrierDepart extends Component
{

    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public function ResetFilter(): void
    {
        $this->reset('privacy','priority','nature','date', 'expediteur','etat');
        $this->resetPage();
    }

    public string $privacy = '';
    public string $priority = '';
    public string $nature = '';
    public string $date = '';
    public string $expediteur = '';
    public string $etat = '';
    public array $selectedRows = [];

    public function render()
    {
        $structureId = Auth::user()->userable->structure_id ?: Auth::user()->userable->departement->structure_id;
        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = Depart::with('user', 'nature', 'correspondant')
            ->when($isSuperadmin, function ($query) use ($structureId) {
                $query->where('structure_id', $structureId);
            });

        if ($this->privacy) {
            $query->where('confidentiel', $this->privacy);
        }

        if ($this->priority) {
            $query->where('priorite', $this->priority);
        }

        if ($this->nature) {
            $query->where('nature_id', $this->nature);
        }

        if ($this->expediteur) {
            $query->where('correspondant_id', $this->expediteur);
        }

        if ($this->date) {
            $query->where('date', $this->date);
        }

        if ($this->etat) {
            $query->where('etat', $this->etat);
        }

        $rows = $query->latest()->paginate(15);

        $correspondantQuery = Correspondant::orderBy('nom');
        $typeQuery = Nature::orderBy('nom');
        $courrierQuery = Courrier::with('nature','correspondant');
        if (!$isSuperadmin) {
            $correspondantQuery->where('structure_id', $structureId);
            $typeQuery->where('structure_id', $structureId);
            $courrierQuery->where('structure_id', $structureId);
        }

        $correspondant = $correspondantQuery->get();
        $type = $typeQuery->get();
        $courrier = $courrierQuery->latest()->get(['id','numero','reference','date']);

        return view('livewire.courrier-depart', compact('rows','correspondant','type','courrier'));
    }
}
