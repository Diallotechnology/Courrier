@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations de la tache N° {{ $task->reference }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Utilisateur Initiateur</div>
                <div class="datagrid-content">
                    <div class="d-flex py-1 align-items-center">
                        <span class="avatar me-2"
                            style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $task->createur->name }}')"></span>
                        <div class="flex-fill">

                            <div class="font-weight-medium">{{ $task->createur->name }}</div>
                            <div class="text-muted text-reset">{{ $task->createur->email }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">reference de la tache</div>
                <div class="datagrid-content">{{ $task->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Nom de la tache</div>
                <div class="datagrid-content">{{ $task->nom }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Type de tache</div>
                <div class="datagrid-content">{{ $task->type }}</div>
            </div>

            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $task->created_at }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de debut</div>
                <div class="datagrid-content">{{ $task->debut_format }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de fin</div>
                <div class="datagrid-content">{{ $task->fin_format }}</div>
            </div>

            <div class="datagrid-item">
                <div class="datagrid-title">Etat de la tache</div>
                <div class="datagrid-content">
                    <x-statut-task :task="$task" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Utilisateurs concerné</div>
                <div class="datagrid-content">
                    @forelse ($task->users as $row)
                    <div class="d-flex py-1 align-items-center">
                        <span class="avatar me-2"
                            style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->name }}')"></span>
                        <div class="flex-fill">
                            <div class="font-weight-medium">{{ $row->name }}</div>
                            <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}
                                    <span @class(['status', 'status-green'=> $row->pivot->etat == 1,
                                        'status-red'=> $row->pivot->etat == 0])>
                                        <span class="status-dot status-dot-animated"></span>
                                        {{ $row->pivot->etat == 1 ? 'Termine' : 'Non termine' }}
                                    </span>
                                </a></div>

                        </div>
                    </div>
                    @empty
                    Aucun
                    @endforelse
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Description de la tache</div>
                <div class="datagrid-content">
                    @empty($task->description)
                    Aucun
                    @else
                    {{ $task->description }}
                    @endempty
                </div>
            </div>

        </div>
    </div>
</div>
@if(Auth::user()->id === $task->createur_id)
@livewire('task-assign', ['task' => $task])
@endif
@endsection