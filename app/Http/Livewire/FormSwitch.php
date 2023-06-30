<?php

namespace App\Http\Livewire;

use App\Enum\CourrierEnum;
use App\Models\Courrier;
use Livewire\Component;

class FormSwitch extends Component
{
    public Courrier $courrier;
    public string $archive = '';
    public bool $show = false;

    public function mount(Courrier $courrier) {
        if($courrier->Archive()) {
            $this->show = true;
        }
    }
    public function render()
    {
        if($this->archive == 1) {
           $this->courrier->etat = CourrierEnum::ARCHIVE;
           $this->courrier->save();
           toastr()->success('Courrier archivé avec success!');
        }
        return view('livewire.form-switch');
    }
}
