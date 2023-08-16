<?php
declare(strict_types=1);
namespace App\Http\Livewire;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dossier extends Component
{
    public string $search = '';

    public string $type = '';

    public string $date = '';

    public function ResetFilter(): void
    {
        $this->reset('type', 'date');
    }

    public function render()
    {
        $query = Folder::withCount('documents')->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->when($this->search, function ($query) {
                $query->where('nom', 'like', '%'.$this->search.'%');
            })
            ->when($this->type, function ($query) {
                $query->where('type', $this->type);
            })
            ->when($this->date, function ($query) {
                $query->orderBy('id', $this->date);
            });
        $rows = $query->paginate(15);

        return view('livewire.dossier', compact('rows'));
    }
}
