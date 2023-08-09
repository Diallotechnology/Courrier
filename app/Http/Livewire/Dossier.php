<?php

namespace App\Http\Livewire;

use App\Models\Folder;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dossier extends Component
{
    public string $search = "";
    public string $type = "";
    public string $date = "";

    public function render()
    {
        $query = Folder::withCount('documents')->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
        ->when($this->search, function ($query) {
            $query->where('nom', 'like','%'.$this->search.'%');
        })
        ->when($this->type, function ($query) {
            $query->where('type', $this->type);
        })
        ->when($this->date, function ($query) {
            $query->orderBy('id',$this->date);
        });
    $rows = $query->paginate(15);
        return view('livewire.dossier', compact('rows'));
    }
}
