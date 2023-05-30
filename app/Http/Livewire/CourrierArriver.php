<?php

namespace App\Http\Livewire;

use App\Models\Nature;
use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use Livewire\WithPagination;
use App\Models\Correspondant;
use Illuminate\Support\Facades\Auth;

class CourrierArriver extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public string $privacy = '';
    public string $priority = '';
    public string $nature = '';
    public string $date = '';
    public string $expediteur = '';
    public string $etat = '';

    public function ResetFilter(): void
    {
        $this->reset('privacy','priority','nature','date', 'expediteur','etat');
        $this->resetPage();

    }

    public function render()
    {
        $structureId = Auth::user()->userable->structure_id ?: Auth::user()->userable->departement->structure_id;
        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = Courrier::with('user', 'nature', 'correspondant')
            ->whereNot('etat', CourrierEnum::ARCHIVE)
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
        if (!$isSuperadmin) {
            $correspondantQuery->where('structure_id', $structureId);
            $typeQuery->where('structure_id', $structureId);
        }

        $correspondant = $correspondantQuery->get();
        $type = $typeQuery->get();
        return view('livewire.courrier-arriver', compact('rows','correspondant','type'));
    }
}
