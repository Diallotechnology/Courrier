<?php
declare(strict_types=1);
namespace App\Http\Livewire;

use App\Exports\DepartExport;
use App\Helper\WithFilter;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Nature;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CourrierDepart extends Component
{
    use WithPagination, WithFilter;

    public string $initiateur = '';

    public function ResetFilter(): void
    {
        $this->reset('privacy', 'priority', 'nature', 'date', 'expediteur', 'etat');
        $this->resetPage();
    }

    public function export()
    {
        return Excel::download(new DepartExport, 'courrier_depart.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function render(): View
    {
        $structureId = Auth::user()->structure();
        $auth = Auth::user();
        $query = Depart::with('user', 'initiateur', 'nature', 'correspondants', 'folder')
            ->when(! $auth->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->when($this->privacy, function ($query) {
                $query->where('confidentiel', $this->privacy);
            })
            ->when($this->priority, function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->nature, function ($query) {
                $query->where('nature_id', $this->nature);
            })
            ->when($this->initiateur, function ($query) {
                $query->where('initiateur_id', $this->initiateur);
            })
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
        if (! $auth->isSuperadmin()) {
            $correspondantQuery->ByStructure();
            $typeQuery->ByStructure();
            $courrierQuery->ByStructure();
        }

        $correspondant = $correspondantQuery->get();
        $type = $typeQuery->get();
        $courrier = $courrierQuery->latest()->get(['id', 'numero', 'reference', 'date']);
        $user = User::with('userable')->when(! $auth->isSuperadmin(), fn ($query) => $query->StructureUser())->get()->groupBy('userable.nom');

        return view('livewire.courrier-depart', compact('rows', 'correspondant', 'type', 'courrier', 'user'));
    }
}
