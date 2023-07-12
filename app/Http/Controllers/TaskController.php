<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Helper\DeleteAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Notifications\TaskNotification;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {

        $data = Arr::except($request->validated(), ['user_id']);
        // create task
        $task = Task::create($data);
        $ref = $task->generateId('TA');
        // Send notification
        $notification = new TaskNotification($task, ' vous avez été assigner');
        if (! empty($request->user_id)) {
            // create task user pivot data
            $task->users()->attach($request->user_id);
            // Get notifiable users' emails
            $users = User::whereIn('id', $request->user_id)->get(['email', 'id']);
            // $emails = $users->pluck('email')->toArray();
            Notification::send($users, $notification);
        }

        // broadcast(new MessageNotification("hdhshsh"))->toOthers();
        $this->journal("Ajout de la tache N°$ref");
        toastr()->success('Taches ajouter avec success!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        $this->authorize('view', $task);

        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $this->authorize('update', $task);
        $user = Auth::user()->isSuperadmin() ?
        User::with('userable')->get()->groupBy('userable.nom') : User::with('userable')->StructureUser()->get()->groupBy('userable.nom');

        return view('task.update', compact('task', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $data = Arr::except($request->validated(), ['user_id']);
        $task->update($data);
        $task->users()->sync($request->user_id);
        toastr()->success('Taches mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task): JsonResponse
    {
        $delete = Task::findOrFail($task);
        $this->journal("Suppression de la tache REF N°$delete->numero");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Task::with('users')->onlyTrashed()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->whereCreateurId(Auth::user()->id))
            ->latest()->paginate(15);

        return view('task.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Task::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré la tache REF N°$row->numero");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Task::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("Suppression definitive de la tache REF N°$row->numero");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré de tous les taches');

        return $this->All_restore(Task::onlyTrashed());
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vidé la corbeille des taches');

        return $this->All_remove(Task::onlyTrashed());
    }
}
