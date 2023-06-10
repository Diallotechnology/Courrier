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
        <span class="text-truncate">Liste des structures</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'une structure entrainera la suppression de ses departements et utlisateurs
            </h3>
        </div>
        <div class="card-body">
            <x-filter url="structure" :create="App\Models\Structure::class" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
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
            <td>{{ $row->contact }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->adresse }}</td>
            <td>{{ $row->departements_count }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit :row="$row" href="{{ route('structure.edit', ['structure' => $row]) }}" />
                <x-button-show :row="$row" href="{{ route('structure.show', ['structure' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('structure/'.$row->id) }}" />
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

<x-modal title="nouvelle structure">
    <x-form route="{{ route('structure.store') }}">

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
        <div class="col-md-12">
            <x-select name="licence" label="Type de licence">
                <option value="0">Version essai</option>
                <option value="1">Licence active</option>
            </x-select>
        </div>
        <x-input type="text" name="adresse" place="l'adresse de la structure" />
        <x-textarea :required='false' place="Fait une description de l'organisation ou de la structure"
            name="description" label="description de la structure " />
    </x-form>
</x-modal>
@endsection