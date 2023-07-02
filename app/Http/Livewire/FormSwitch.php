<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use Illuminate\Contracts\View\View;

class FormSwitch extends Component
{
    public Courrier $courrier;

    public string $archive = '';

    public bool $show = false;

    public function mount(Courrier $courrier)
    {
        if ($courrier->Archive()) {
            $this->show = true;
        }
    }

    public function render(): View
    {
        if ($this->archive == 1) {
            $this->courrier->etat = CourrierEnum::ARCHIVE;
            $this->courrier->save();
            toastr()->success('Courrier archivé avec success!');
        }

        return view('livewire.form-switch');
    }
}
