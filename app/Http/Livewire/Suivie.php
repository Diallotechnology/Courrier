<?php

namespace App\Http\Livewire;

use App\Models\Nature;
use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use Livewire\WithPagination;
use App\Models\Correspondant;

class Suivie extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public string $privacy = '';
    public string $priority = '';
    public string $nature = '';
    public string $date = '';
    public string $expediteur = '';
    public string $etat = '';

    public function ResetFilter(): void
    {
        $this->reset('privacy','priority','nature','date', 'expediteur','etat');
        $this->resetPage();
    }

    public function render()
    {
        if ($this->privacy || $this->priority  || $this->nature || $this->date || $this->etat || $this->expediteur) {
            $rows = Courrier::with('user','nature','correspondant')->whereNot('etat',CourrierEnum::SAVE)
            ->when($this->privacy && !empty($this->privacy), function ($query) {
                $query->where('confidentiel', $this->privacy);
            })
            ->when($this->priority && !empty($this->priority), function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->nature && !empty($this->nature), function ($query) {
                $query->where('nature_id', $this->nature);
            })
            ->when($this->expediteur && !empty($this->expediteur), function ($query) {
                $query->where('correspondant_id', $this->expediteur);
            })
            ->when($this->date && !empty($this->date), function ($query) {
                $query->where('date', $this->date);
            })
            ->when($this->etat && !empty($this->etat), function ($query) {
                $query->where('etat', $this->etat);
            })->latest()->paginate(15);
        } else {
            $rows = Courrier::with('user','nature','correspondant')->whereNot('etat',CourrierEnum::SAVE)->whereNot('etat',CourrierEnum::ARCHIVE)->latest()->paginate(15);
        }
        $correspondant = Correspondant::orderBy('nom')->get();
        $type = Nature::orderBy('nom')->get();
        return view('livewire.suivie', compact('rows','correspondant','type'));
    }
}
