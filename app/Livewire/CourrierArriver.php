<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Nature;
use Livewire\Component;
use App\Models\Courrier;
use App\Helper\WithFilter;
use Livewire\WithPagination;
use App\Models\Correspondant;
use Livewire\Attributes\Lazy;
use App\Exports\CourrierExport;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class CourrierArriver extends Component
{
    use WithFilter, WithPagination;

    public function ResetFilter(): void
    {
        $this->reset('privacy', 'priority', 'nature', 'date', 'expediteur', 'etat');
        $this->resetPage();

    }

    public function export()
    {
        return Excel::download(new CourrierExport, 'courrier_arriver.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // (new CourrierExport)->queue('courrier_arriver.xlsx');
        // return toastr()->success('Courrier exporté avec success!');
    }

    public function render(): View
    {
        $isSuperadmin = Auth::user()->isSuperadmin();
        $query = Courrier::with('user', 'nature', 'correspondant', 'structure', 'folder')
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
        $rows = $query->latest('id')->paginate(15);
        $correspondant = Correspondant::when(! $isSuperadmin, fn ($query) => $query->ByStructure())->orderBy('nom')->get();
        $type = Nature::when(! $isSuperadmin, fn ($query) => $query->ByStructure())->orderBy('nom')->get();

        return view('livewire.courrier-arriver', compact('rows', 'correspondant', 'type'));
    }
}
