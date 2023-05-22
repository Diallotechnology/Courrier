<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(StoreTaskRequest $request)
    {
        $data = Arr::except($request->validated(),['user_id']);
        // create task
        $task = Task::create($data);
        $task->generateId('TA');
        // create task user pivot data
        $task->users()->attach($request->user_id);
        // Get notifiable users' emails
        $users = User::whereIn('id', $request->user_id)->get(['email']);
        // $emails = $users->pluck('email')->toArray();

        // Send notification
        $notification = new TaskNotification($task, "Une tache vous avez été assigner");
        Notification::send($users, $notification);
        toastr()->success('Taches ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $user = User::with('departement')->where('id','!=',Auth::user()->id)->get()->groupBy('departement.nom');
        return view('task.update', compact('task','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = Arr::except($request->validated(),['user_id']);
        $task->update($data);
        $task->users()->sync($request->user_id);
        // \dd($request->validated());
        toastr()->success('Taches mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task)
    {
        $delete = Task::findOrFail($task);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Task::with('users')->onlyTrashed()->latest()->paginate(15);
        return view('task.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Task::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Task::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Task::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Task::onlyTrashed());
    }
}
