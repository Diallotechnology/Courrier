<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Enum\TaskEnum;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class TaskAssign extends Component
{
    public Task $task;

    public $user_id;

    public function valid()
    {
        $this->task->users()->attach($this->user_id);
        $notification = new TaskNotification($this->task, 'une tache vous a été assigner');
        $users = User::whereIn('id', $this->user_id)->get(['email', 'id']);
        Notification::send($users, $notification);
        $this->task->update(['etat' => TaskEnum::EN_COURS]);
        $this->reset('user_id');
        toastr()->success('utilisateur assigné avec success!');

        return to_route('task.show', ['task' => $this->task]);
    }

    public function render(): View
    {
        $excludedIds = $this->task->users()->pluck('id')->push($this->task->createur_id);
        $user = User::with('userable')->whereNotIn('id', $excludedIds)
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->StructureUser())
            ->get()->groupBy('userable.nom');

        return view('livewire.task-assign', compact('user'));
    }
}
