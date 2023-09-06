<?php

namespace App\Livewire;

use App\Models\Nature;
use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use App\Helper\WithFilter;
use Livewire\WithPagination;
use App\Models\Correspondant;
use Illuminate\Support\Facades\Auth;

class Archive extends Component
{
    use WithPagination, WithFilter;

    public string $archive = '';
    public function ResetFilter(): void
    {
        $this->reset('privacy', 'priority', 'nature', 'date', 'expediteur', 'etat');
        $this->resetPage();
    }

    public function render()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = Courrier::with('user', 'nature', 'correspondant', 'structure')
            ->where('etat', CourrierEnum::ARCHIVE)
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
            ->when($this->archive, function ($query) {
                $query->where('archived_at', $this->archive);
            })
            ->when($this->date, function ($query) {
                $query->where('date', $this->date);
            });
        $rows = $query->latest('id')->paginate(15);
        $correspondant = Correspondant::when(! $isSuperadmin, fn ($query) => $query->ByStructure())->orderBy('nom')->get();
        $type = Nature::when(! $isSuperadmin, fn ($query) => $query->ByStructure())->orderBy('nom')->get();
        return view('livewire.archive', compact('rows', 'correspondant', 'type'));
    }
}
