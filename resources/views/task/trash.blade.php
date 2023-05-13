@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Corbeille des taches</h3>
        </div>
        <div class="card-body">

            <x-filter trash="task" :create="false" />
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
            <th>Date de suppression</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url(./static/avatars/006m.jpg)"></span>
                    <div class="flex-fill">
                        {{-- <div class="font-weight-medium">{{ $row->name }}</div> --}}
                        {{-- <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}</a></div> --}}
                        {{-- <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true])></span> {{ $row->etat == true ? 'En ligne' : 'Pas ligne' }} --}}
                    </div>
                </div>
            </td>
            <td>{{ $row->type }}</td>
            <td>
                <p class="text-muted">{{ $row->description }}</p>

            </td>
            <td>{{ $row->debut_format }}</td>
            <td>{{ $row->fin_format }}</td>
            <td>
                <span @class(['status', 'status-green'=> $row->Complet(),
                    'status-red'=> $row->No_complet(),
                    'status-orange'=> $row->Pending(),
                    'status-indigo' => $row->Progress(),
                    ])>
                    {{ $row->etat }}
                </span>
            </td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore url="{{ url('task/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('task/delete/'.$row->id) }}" />
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