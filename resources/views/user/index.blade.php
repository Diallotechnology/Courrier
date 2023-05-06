@extends('layouts.app')
@section('content')
<x-table>
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des departements
                <br> NB: La suppression d'un departement entrainera la suppression de ses utlisateurs
            </h3>

        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <x-button-modal />

                <div class="ms-auto text-muted">
                    Recherche:
                    <div class="ms-2 d-inline-block">
                        <input type="text" onkeyup="myFunction()" id="myInput" class="form-control form-control-sm"
                            aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Structure</th>
            <th>Nom du department</th>
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
            <td>{{ $row->structure->nom }}</td>
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
        @endforeach
    </tbody>
</x-table>
<x-modal title="nouveaux departement">
    <x-form route="{{ route('departement.store') }}">
        <x-input type="text" name="nom" place="le nom du departement" />
        <x-input type="text" name="code" place="le code du departement" />
        <x-select name="structure_id" label="structure">
            @foreach ($structure as $row)
            <option value="{{ $row->id }}">{{ $row->nom }}</option>
            @endforeach
        </x-select>
    </x-form>
</x-modal>
@endsection