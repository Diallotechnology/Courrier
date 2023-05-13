@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Corbeille des departements</h3>
        </div>
        <div class="card-body">

            <x-filter trash="departement" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Structure</th>
            <th>Nom du departement</th>
            <th>Code</th>
            <th>Utilisateurs</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->users_count }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore url="{{ url('departement/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('departement/delete/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection