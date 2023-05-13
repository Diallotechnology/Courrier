@extends('layouts.app')
@section('content')
<x-table>
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des taches
                <br> NB: La suppression d'une structure entrainera la suppression de ses departements et utlisateurs
            </h3>

        </div>
        <div class="card-body">
            <x-filter url="task" />
        </div>


    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Type</th>
            <th>Description</th>
            <th>Debut de la tache</th>
            <th>Fin de la tache</th>
            <th>Etat</th>
            <th>Date de creation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->type }}</td>
            <td>
                <p class="text-muted">{{ $row->description }}</p>

            </td>
            <td>{{ $row->debut_format }}</td>
            <td>{{ $row->fin_format }}</td>
            <td>
                <x-statut-task :task="$row" />
            </td>
            <td>{{ $row->created_at }}</td>
            <td>

                <x-button-edit href="{{ route('task.edit', ['task' => $row]) }}" />
                <x-button-show href="{{ route('task.show', ['task' => $row]) }}" />
                <x-button-delete url="{{ url('task/'.$row->id) }}" />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <h2 class="text-center">Aucun element</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>
<x-modal title="nouvelle tache">
    <x-form route="{{ route('task.store') }}">
        <div class="row">
            <div class="col-md-6">
                <x-input type="text" name="nom" place="le nom de la tache" />
            </div>
            <div class="col-md-6">
                <x-select name="type" label="Ttype de tache">
                    <option value="">test</option>
                    <option value="">test</option>
                    <option value="">test</option>
                </x-select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-input type="date" name="debut" label="Debut de la tache" :required='false' />
            </div>
            <div class="col-md-6">
                <x-input type="date" name="fin" label="Fin de la tache" :required='false' />
            </div>
        </div>
        <x-textarea place="Fait une description de la tache" name="description" label="description de la taches" />
    </x-form>
</x-modal>
@endsection
