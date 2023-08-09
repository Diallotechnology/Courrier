<?php

namespace App\Http\Livewire;

use App\Models\Document as ModelsDocument;
use App\Models\Folder;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Document extends Component
{
    public string $search = "";

    public function render()
    {
        $rows = Folder::withCount('documents','folderable')->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
        ->when($this->search, function ($query) {
            $query->where('nom', 'like','%'.$this->search.'%');
        })
        ->orderBy('nom')->paginate(15);
        return view('livewire.document', compact('rows'));
    }
}
