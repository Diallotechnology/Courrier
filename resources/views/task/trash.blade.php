@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Taches</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des taches</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" trash="task" :create="false">
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>reference</th>
            <th>Type de tache</th>
            <th>nom de la tache</th>
            <th>Debut de la tache</th>
            <th>Fin de la tache</th>
            <th>Etat de la tache</th>
            <th>Date de suppression</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                @if($row->createur)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->createur->name }}')"></span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->createur->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $row->createur->email }}</a>
                        </div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>
            <td>{{ $row->numero }}</td>
            <td>{{ $row->type }}</td>
            <td>
                {{ $row->nom }}
            </td>
            <td>{{ $row->debut_format }}</td>
            <td>{{ $row->fin_format }}</td>
            <td>
                <x-statut-task :task="$row" />
            </td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore :row="$row" url="{{ url('task/restore/'.$row->id) }}" />
                @can('forceDelete')
                <x-button-delete :row="$row" url="{{ url('task/delete/'.$row->id) }}" />
                @endcan
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
@endsection