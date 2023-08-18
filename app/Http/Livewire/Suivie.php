<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Enum\CourrierEnum;
use App\Helper\WithFilter;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Nature;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Suivie extends Component
{
    use WithPagination, WithFilter;

    public function ResetFilter(): void
    {
        $this->reset('privacy', 'priority', 'nature', 'date', 'expediteur', 'etat');
        $this->resetPage();
    }

    public function render(): View
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = Courrier::with('user', 'nature', 'correspondant', 'structure')
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
            ->when($this->expediteur, function ($query) {
                $query->where('correspondant_id', $this->expediteur);
            })
            ->when($this->date, function ($query) {
                $query->where('date', $this->date);
            })
            ->when($this->etat, function ($query) {
                $query->where('etat', $this->etat);
            });
        $rows = $query->whereNot('etat', CourrierEnum::SAVE)->whereNot('etat', CourrierEnum::ARCHIVE)->latest('id')->paginate(15);
        $correspondant = Correspondant::when(! $isSuperadmin, fn ($query) => $query->ByStructure())->orderBy('nom')->get();
        $type = Nature::when(! $isSuperadmin, fn ($query) => $query->ByStructure())->orderBy('nom')->get();

        return view('livewire.suivie', compact('rows', 'correspondant', 'type'));
    }
}
