@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Departement</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des departements</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'un departement entrainera la suppression de ses utlisateurs
            </h3>
        </div>
        <div class="card-body">
            <x-filter url="departement" />
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
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->users_count }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit href="{{ route('departement.edit', ['departement' => $row]) }}" />
                <x-button-show href="{{ route('departement.show', ['departement' => $row]) }}" />
                <x-button-delete url="{{ url('departement/'.$row->id) }}" />
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
<x-modal title="nouveaux departement">
    <x-form route="{{ route('departement.store') }}">
        <x-input type="text" name="nom" place="le nom du departement" />
        <x-input type="text" name="code" place="le code du departement" />
        @if(Auth::user()->isSuperadmin())
        <x-select name='structure_id' label="structure">
            @foreach ($structure as $row)
            <option value="{{ $row->id }}">{{ $row->nom }}</option>
            @endforeach
        </x-select>
        @else
        <input type="hidden" value="{{ Auth::user()->departement->structure_id }}" name="structure_id">
        @endif
    </x-form>
</x-modal>
@endsection