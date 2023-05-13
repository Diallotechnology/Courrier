@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Corbeille des utilisateurs</h3>
        </div>
        <div class="card-body">

            <x-filter trash="user" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Poste</th>
            <th>Department</th>
            <th>Role</th>
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
                        <div class="font-weight-medium">{{ $row->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}</a></div>
                        <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true])></span> {{ $row->etat == true ? 'En ligne' : 'Pas ligne' }}
                    </div>
                </div>
            </td>
            <td>{{ $row->poste }}</td>
            <td data-label="Title">
                <div>{{ $row->departement->nom }}</div>
                <div class="text-muted">{{ $row->imputations_count }} Imputations</div>
            </td>
            <td>{{ $row->role }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore url="{{ url('user/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('user/delete/'.$row->id) }}" />
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