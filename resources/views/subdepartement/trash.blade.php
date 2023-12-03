@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Sous Departement</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des sous departements</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" trash="subdepartement" :create="false">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>departement</th>
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
            <td>{{ $row->departement ? $row->departement->nom : 'inexistant' }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->users_count }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore :row="$row" url="{{ url('subdepartement/restore/'.$row->id) }}" />
                @can('forceDelete')
                <x-button-delete :row="$row" url="{{ url('subdepartement/delete/'.$row->id) }}" />
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection