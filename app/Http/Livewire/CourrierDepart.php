<?php

namespace App\Http\Livewire;

use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Nature;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CourrierDepart extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public function ResetFilter(): void
    {
        $this->reset('privacy', 'priority', 'nature', 'date', 'expediteur', 'etat');
        $this->resetPage();
    }

    public string $privacy = '';

    public string $priority = '';

    public string $nature = '';

    public string $date = '';

    public string $expediteur = '';

    public string $etat = '';

    public function render(): View
    {
        $structureId = Auth::user()->structure();
        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = Depart::with('user', 'nature', 'correspondants')
            ->when(! $isSuperadmin, fn ($query) => $query->ByStructure())
            ->when($this->privacy, function ($query) {
                $query->where('confidentiel', $this->privacy);
            })
            ->when($this->priority, function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->nature, function ($query) {
                $query->where('nature_id', $this->nature);
            })
            // ->when($this->expediteur, function ($query) {
            //     $query->where('correspondant_id', $this->expediteur);
            // })
            ->when($this->date, function ($query) {
                $query->where('date', $this->date);
            })
            ->when($this->etat, function ($query) {
                $query->where('etat', $this->etat);
            });

        $rows = $query->latest('id')->paginate(15);

        $correspondantQuery = Correspondant::orderBy('nom');
        $typeQuery = Nature::orderBy('nom');
        $courrierQuery = Courrier::with('nature', 'correspondant');
        if (! $isSuperadmin) {
            $correspondantQuery->ByStructure();
            $typeQuery->ByStructure();
            $courrierQuery->ByStructure();
        }

        $correspondant = $correspondantQuery->get();
        $type = $typeQuery->get();
        $courrier = $courrierQuery->latest()->get(['id', 'numero', 'reference', 'date']);

        return view('livewire.courrier-depart', compact('rows', 'correspondant', 'type', 'courrier'));
    }
}
