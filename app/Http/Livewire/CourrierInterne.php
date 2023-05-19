<?php

namespace App\Http\Livewire;

use App\Models\Nature;
use App\Models\Interne;
use App\Models\User;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CourrierInterne extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public function ResetFilter(): void
    {
        $this->reset('privacy','priority','nature','destinataire','etat');
        $this->resetPage();
    }

    public string $privacy = '';
    public string $priority = '';
    public string $nature = '';
    public string $destinataire = '';
    public string $etat = '';

    public function render()
    {
        if ($this->privacy || $this->priority  || $this->nature || $this->etat || $this->destinataire) {
            $rows = Interne::with('user','nature','destinataire','expediteur')
            ->when($this->privacy && !empty($this->privacy), function ($query) {
                $query->where('confidentiel', $this->privacy);
            })
            ->when($this->priority && !empty($this->priority), function ($query) {
                $query->where('priorite', $this->priority);
            })
            ->when($this->nature && !empty($this->nature), function ($query) {
                $query->where('nature_id', $this->nature);
            })
            ->when($this->destinataire && !empty($this->destinataire), function ($query) {
                $query->where('destinataire_id', $this->destinataire);
            })
            ->when($this->etat && !empty($this->etat), function ($query) {
                $query->where('etat', $this->etat);
            })->latest()->paginate(15);
        } else {
            $rows = Interne::with('user','nature','destinataire','expediteur')->latest()->paginate(15);
        }
        $type = Nature::orderBy('nom')->get();

        return view('livewire.courrier-interne', compact('rows','type'));
    }
}
