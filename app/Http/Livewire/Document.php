<?php
declare(strict_types=1);
namespace App\Http\Livewire;

use App\Models\Folder;
use Livewire\Component;

class Document extends Component
{
    public Folder $folder;

    public string $type = '';

    public string $date = '';

    public function ResetFilter(): void
    {
        $this->reset('type', 'date');
    }

    public function render()
    {
        $rows = $this->folder->documents()
            ->when($this->type, function ($query) {
                $query->where('extension', $this->type);
            })
            ->when($this->date, function ($query) {
                $query->orderBy('id', $this->date);
            })->get();

        return view('livewire.document', compact('rows'));
    }
}
