@props(['task'])
@if($task)

<span @class(['status', 'status-green'=> $task->Complet(),
    'status-red'=> $task->No_complet(),
    'status-orange'=> $task->Pending(),
    'status-indigo' => $task->Progress(),
    ])>
    <span class="status-dot status-dot-animated"></span>
    {{ $task->etat }}

</span>

@endif