<?php

namespace App\Http\Livewire;

use App\Models\Document as ModelsDocument;
use App\Models\Folder;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Document extends Component
{
    public Folder $folder;
    public string $type = "";
    public string $date = "";

    public function ResetFilter(): void
    {
        $this->reset('type','date');
    }

    public function render()
    {
        $rows = $this->folder->documents()
        ->when($this->type, function ($query) {
            $query->where('extension',$this->type);
        })
        ->when($this->date, function ($query) {
            $query->orderBy('id',$this->date);
        })->get();
        return view('livewire.document', compact('rows'));
    }
}
