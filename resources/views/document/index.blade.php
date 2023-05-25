@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Document</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des documents de courrier</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter url="document" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>type</th>
            <th>Chemin</th>
            <th>Date de creation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->libelle }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->chemin }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit href="{{ route('document.edit', ['document' => $row]) }}" />
                <x-button-show href="{{ route('document.show', ['document' => $row]) }}" target="_blank" />
                <x-button-delete url="{{ url('document/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>

<x-modal title="nouveaux document">
    <x-form route="{{ route('document.store') }}" enctype="multipart/form-data">
        <div class="col-md-6">
            <x-input type="text" name="libelle" place="libelle du document" />
        </div>
        <div class="col-md-6">
            <x-input type="file" multiple name="document" label='Piece jointes ou fichiers PDF' />
        </div>
        <x-select name='type'>
            <option value="Arrivé">Arrivé</option>
            <option value="Depart">Depart</option>
            <option value="Interne">Interne</option>
        </x-select>
        {{-- <x-select name='structure_id'>
            @foreach ($courrier as $row)
            <option value="{{ $row->id }}">Courrier N°{{ $row->reference }}</option>
            @endforeach
        </x-select> --}}
    </x-form>
</x-modal>
@endsection