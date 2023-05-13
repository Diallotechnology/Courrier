@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites de la journalisation des utilisateurs</h3>
        </div>
        <div class="card-body">
            <x-filter :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Libelle</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>

            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->libelle }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-delete url="{{ url('journal/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
