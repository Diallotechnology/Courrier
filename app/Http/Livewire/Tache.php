<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Enum\TaskEnum;
use Livewire\Component;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use App\Enum\ImputationEnum;
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
        $task = Task::with('courrier','imputation')->findOrFail($id);
        $task->updateOrFail(['etat' => TaskEnum::TERMINE]);

        if ($task->type === "imputation") {
            if ($task->courrier && $task->courrier->impute()) {
                $task->courrier->update(['etat' => CourrierEnum::PROCESS]);
            }
            if ($task->imputation && $task->imputation->Pending()) {
                $task->imputation->update(['etat' => ImputationEnum::EN_COURS]);
            }
            if ($task->courrier) {
                $courrier = $task->courrier;
                $id = $courrier->id;
                $num = $courrier->numero;

                // Send notification
                $notification = new TaskNotification($task, "Une tache d'imputation que vous avez assigné a été effectuer");
                $task->createur->notify($notification);

                $this->history($id, "validation de tache", "Une tache du courrier N°$num a été validé");

                // Verify if all tasks for the courrier are completed
                $incompleteTasksCount = Task::whereCourrierId($courrier->id)
                    ->whereEtat('!=', TaskEnum::TERMINE)
                    ->count();

                if ($incompleteTasksCount === 0) {
                    $courrier->updateOrFail(['etat' => CourrierEnum::TERMINE]);
                    $this->history($id, "tache terminé", "Toute les taches du courrier arrivé N°$num sont terminés");
                }
            }
        } else {
            // Send notification
            $notification = new TaskNotification($task, "Une tache que vous avez assigné a été effectuer");
            $task->createur->notify($notification);
        }
        toastr()->success('Tache validé avec succès!');
    }


    public function render()
    {

        $auth = Auth::user();
        $query = Task::with('createur','users')
            ->when(!$auth->isSuperadmin(), fn($query) => $query->whereCreateurId($auth->id))
            ->when($this->type, function ($query) {
                $query->where('type', $this->type);
            })
            ->when($this->debut, function ($query) {
                $query->where('debut', $this->debut);
            })
            ->when($this->fin, function ($query) {
                $query->where('fin', $this->fin);
            })
            ->when($this->etat, function ($query) {
                $query->where('etat', $this->etat);
            });

        $rows = $query->latest()->paginate(15);
        $user = User::with('userable')->when(!$auth->isSuperadmin(), fn($query) => $query->StructureUser())->get()
        ->groupBy('userable.nom');
        return view('livewire.tache', compact('user','rows'));
    }
}
