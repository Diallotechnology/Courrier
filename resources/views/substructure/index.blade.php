@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Structure</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des sous structures</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'une sous structure entrainera la suppression de ses departements et
                utlisateurs
            </h3>
        </div>
        <div class="card-body">
            <x-filter url="substructure" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>structure</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Total department</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->contact }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->adresse }}</td>
            <td>{{ $row->departements_count }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit href="{{ route('substructure.edit', ['substructure' => $row]) }}" />
                <x-button-show href="{{ route('substructure.show', ['substructure' => $row]) }}" />
                <x-button-delete url="{{ url('substructure/'.$row->id) }}" />
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

<x-modal title="nouvelle sous structure">
    <x-form route="{{ route('substructure.store') }}">

        <div class="col-md-6">
            <x-input type="text" name="nom" place="le nom de la structure" />
        </div>
        <div class="col-md-6">
            <x-input type="text" name="contact" place="le contact de la structure" />
        </div>

        <div class="col-md-6">
            <x-input type="email" name="email" place="email de la structure" />
        </div>
        <div class="col-md-6">
            <x-input type="file" name="logo" label="Logo Faculatif" :required='false' />
        </div>
        @if(Auth::user()->isSuperadmin())
        <x-select name='structure_id' label="structure">
            @foreach ($structure as $row)
            <option value="{{ $row->id }}">{{ $row->nom }}</option>
            @endforeach
        </x-select>
        @else
        <input type="hidden" value="{{ Auth::user()->departement->structure_id }}" name="structure_id">
        @endif
        <x-input type="text" name="adresse" place="l'adresse de la structure" />
        <x-textarea :required='false' place="Fait une description de l'organisation ou de la structure"
            name="description" label="description de la structure " />
    </x-form>
</x-modal>
@endsection