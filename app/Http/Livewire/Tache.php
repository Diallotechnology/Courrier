<?php

namespace App\Http\Livewire;

use App\Enum\CourrierEnum;
use App\Enum\TaskEnum;
use App\Helper\DeleteAction;
use App\Models\Courrier;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Tache extends Component
{
    use WithPagination, DeleteAction;

    protected string $paginationTheme = 'bootstrap';
    public string $type = '';
    public string $debut = '';
    public string $fin = '';
    public string $etat = '';
    public $task;

    public function ResetFilter(): void
    {
        $this->reset('type','debut','fin','etat');
        $this->resetPage();
    }

    public function ValidTask(int $id): void
    {
       $task = Task::findOrFail($id);
       $task->updateOrFail(['etat' => TaskEnum::TERMINE]);
        // create action history
        if($task->type === "imputation") {

            // update courrier etat if is impute
            if($task->courrier->Impute()) {
                $task->courrier->update(['etat' => CourrierEnum::PROCESS]);
            }

            $id = $task->courrier_id;
            $num = $task->courrier->numero;
            $this->history($id,"validation de tache","Une tache du courrier N°$num validé");

            // verify if all task to courrier is complet
            $get_courrier_task = Task::whereCourrierId($task->courrier_id)->whereEtat(!TaskEnum::TERMINE)->get();

            if($get_courrier_task->isEmpty()) {
                $task->courrier->update(['etat' => CourrierEnum::TERMINE]);
                $id = $task->courrier_id;
                $num = $task->courrier->numero;
                $this->history($id,"tache accompli","Toute les tache du courrier N°$num effectué");
            }
        }
        toastr()->success('Tache validé avec success!');
    }

    public function render()
    {
        if ($this->type || $this->debut  || $this->fin || $this->etat) {
            $rows = Task::with('user')
            ->when($this->type && !empty($this->type), function ($query) {
                $query->where('type', $this->type);
            })
            ->when($this->debut && !empty($this->debut), function ($query) {
                $query->where('debut', $this->debut);
            })
            ->when($this->fin && !empty($this->fin), function ($query) {
                $query->where('fin', $this->fin);
            })
            ->when($this->etat && !empty($this->etat), function ($query) {
                $query->where('etat', $this->etat);
            })->latest()->paginate(15);
        } else {
            $rows = Task::with('createur')->latest()->paginate(15);
        }
        $user = User::with('departement')->where('id','!=',Auth::user()->id)->get()->groupBy('departement.nom');
        return view('livewire.tache', compact('user','rows'));
    }
}
