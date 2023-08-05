<?php

namespace App\Http\Livewire;

use Auth;
use App\Models\Nature;
use App\Models\Interne;
use Livewire\Component;
use App\Helper\WithFilter;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class CourrierInterne extends Component
{
    use WithPagination, WithFilter;

    public function ResetFilter(): void
    {
        $this->reset('privacy', 'priority', 'nature', 'destinataire', 'etat');
        $this->resetPage();
    }

    public string $destinataire = '';

    public function render(): View
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $userId = Auth::user()->id;

        $query = Interne::with('nature', 'destinataire', 'expediteur', 'reponses')
            ->when(! $isSuperadmin, function ($query) use ($userId) {
                $query->where(function ($query) use ($userId) {
                    $query->where('destinataire_id', $userId)
                        ->orWhere('expediteur_id', $userId);
                });
            })
            ->when($this->privacy, function ($query) {
                $query->where('confidentiel', $this->privacy);
            })
            ->when($this->priority, function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->nature, function ($query) {
                $query->where('nature_id', $this->nature);
            })
            ->when($this->etat, function ($query) {
                $query->where('etat', $this->etat);
            });
        $rows = $query->latest('id')->paginate(15);
        $typeQuery = Nature::orderBy('nom')->when(! $isSuperadmin, fn ($query) => $query->where('structure_id', Auth::user()->structure()));
        $type = $typeQuery->get();

        return view('livewire.courrier-interne', compact('rows', 'type'));
    }
}
