<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Enum\TaskEnum;
use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use App\Helper\DeleteAction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Tache extends Component
{
    use WithPagination, DeleteAction;

    protected string $paginationTheme = 'bootstrap';
    public string $type = '';
    public string $debut = '';
    public string $fin = '';
    public string $etat = '';
    public string $selectbox = '';
    public string $type_select = '';
    public bool $show = false;

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
            if($task->courrier and $task->courrier->Impute()) {
                $task->courrier->update(['etat' => CourrierEnum::PROCESS]);
            }
            if($task->courrier) {

                $id = $task->courrier_id;
                $num = $task->courrier->numero;
                // Send notification
                $notification = new TaskNotification($task, "Une tache d'imputation que vous avez assigné a été effectuer");
                $task->createur->notify($notification);

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

        } else {
            // Send notification
            $notification = new TaskNotification($task, "Une tache que vous avez assigné a été effectuer");
            $task->createur->notify($notification);
        }

        toastr()->success('Tache validé avec success!');
    }

    public function render()
    {

        if ($this->type || $this->debut  || $this->fin || $this->etat) {
            $rows = Task::with('createur')
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

            if (Auth::user()->isSuperadmin()) {
                $user = Task::with('users','createur')->paginate(15);
            } else {
                $rows = Task::with('users','createur')->whereCreateurId(Auth::user()->id)->paginate(15);
            }
        }
        $user = User::with('userable')->where('id','!=',Auth::user()->id)->get()->groupBy('userable.nom');
        return view('livewire.tache', compact('user','rows'));
    }
}
