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
    public string $archive = '';

    public function ResetFilter(): void
    {
        $this->reset('privacy','priority','nature','date', 'expediteur','etat');
        $this->resetPage();

    }

    public function test(Courrier $row) {
        $row->update(['etat' => CourrierEnum::ARCHIVE]);
        toastr()->success('Courrier archiver avec success!');
        // \dd($row);
    }

    public function render()
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = Courrier::with('user', 'nature', 'correspondant','structure')
            ->whereNot('etat', CourrierEnum::ARCHIVE)
            ->when(!$isSuperadmin, fn($query) => $query->ByStructure())
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

        $rows = $query->latest()->paginate(15);
        $correspondantQuery = Correspondant::orderBy('nom');
        $typeQuery = Nature::orderBy('nom');
        if (!$isSuperadmin) {
            $correspondantQuery->ByStructure();
            $typeQuery->ByStructure();
        }

        $correspondant = $correspondantQuery->get();
        $type = $typeQuery->get();
        return view('livewire.courrier-arriver', compact('rows','correspondant','type'));
    }
}
