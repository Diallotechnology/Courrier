<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Enum\TaskEnum;
use Livewire\Component;
use App\Enum\CourrierEnum;
use App\Models\Imputation;
use App\Enum\ImputationEnum;
use App\Helper\DeleteAction;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskNotification;
use App\Notifications\ImputationNotification;

class Tache extends Component
{
    use WithPagination, DeleteAction;

    protected string $paginationTheme = 'bootstrap';

    public string $type = '';

    public string $debut = '';

    public string $fin = '';

    public string $etat = '';

    public string $imputation = '';

    public function ResetFilter(): void
    {
        $this->reset('type', 'debut', 'fin', 'etat');
        $this->resetPage();
    }

    public function ValidTask(int $id): void
    {
        // get task
        $task = Task::with('imputation', 'users')->findOrFail($id);
        // update user pivot etat
        $task->users()->updateExistingPivot(Auth::user()->id, ['etat' => 1]);
        // Verify if all tasks for the imputation are completed
        $incompleteTasksUserCount = $task->users()->wherePivot('etat', 0)->exists();
        if (! $incompleteTasksUserCount) {
            // update task to terminie
            $task->updateOrFail(['etat' => TaskEnum::TERMINE]);
        }
        if ($task->type === 'imputation' && $task->imputation && $task->imputation->courrier) {
            $courrier = $task->imputation->courrier;
            // update imputation courrier etat
            $courrier->impute() ?: $courrier->update(['etat' => CourrierEnum::PROCESS]);
            // update imputation etat
            $task->imputation->Pending() ?: $task->imputation->update(['etat' => ImputationEnum::EN_COURS]);

            $id = $courrier->id;
            $num = $courrier->numero;
            // Send notification
            $notification = new TaskNotification($task, "Une tache d'imputation que vous avez assigné a été effectuer");
            $task->createur->notify($notification);
            $this->history($id, 'validation de tache', "La tache N°$task->numero du courrier arrivé N°$num a été validé");
            // Verify if all tasks for the imputation are completed
            $incompleteTasksCount = Task::where('imputation_id', $task->imputation_id)->whereEtat('!=', TaskEnum::TERMINE)->exists();
            if (! $incompleteTasksCount) {
                $task->imputation->updateOrFail(['fin_traitement' => today(), 'etat' => ImputationEnum::TERMINE]);
                $notification = new ImputationNotification($task->imputation, "l'imputation N°".$task->imputation->numero.'terminé avec success');
                $task->imputation->user->notify($notification);
                $courrier->updateOrFail(['etat' => CourrierEnum::TERMINE]);
                $this->history($id, 'tache terminé', "Toute les taches du courrier arrivé N°$num sont terminés");
            }
        } else {
            // Send notification
            $notification = new TaskNotification($task, 'Une tache que vous avez assigné a été effectuer');
            $task->createur->notify($notification);
        }
        toastr()->success('Tache validé avec succès!');
    }

    public function render(): View
    {
        $auth = Auth::user();
        $query = Task::with('createur', 'users')
            ->when(! $auth->isSuperadmin(), fn ($query) => $query->where('createur_id', $auth->id))
            ->orWhereHas('users', fn ($query) => $query->where('user_id', $auth->id))
            ->when($this->imputation, function ($query) {
                $query->where('imputation_id', $this->imputation);
            })
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

        $rows = $query->latest('id')->paginate(15);
        $user = User::with('userable')->when(! $auth->isSuperadmin(), fn ($query) => $query->StructureUser())
            ->whereNot('id', $auth->id)->get()->groupBy('userable.nom');
        $imp = Imputation::when(! $auth->isSuperadmin(), fn ($query) => $query->ByStructure())->orderBy('numero')->get();

        return view('livewire.tache', compact('user', 'rows', 'imp'));
    }
}
