<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    use DeleteAction;
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
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
