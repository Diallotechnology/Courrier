@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des utilisateurs
                <br> NB: La suppression d'un utilisateur entrainera la suppression de ses courriers et imputations
            </h3>

        </div>
        <div class="card-body border-bottom py-3">
            <x-filter url="user" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Poste</th>
            <th>Department</th>
            <th>Role</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url(./static/avatars/006m.jpg)">
                        <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true])></span>
                    </span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}</a></div>
                        {{-- <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true]) ></span> {{ $row->etat == true ? 'En ligne' : 'Pas ligne' }} --}}
                    </div>
                </div>
            </td>
            <td>{{ $row->poste }}</td>
            <td data-label="Title">
                <div>{{ $row->departement->nom }}</div>
                <div class="text-muted">{{ $row->imputations_count }} Imputations</div>
            </td>
            <td>{{ $row->role }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                {{--
                <x-button-edit href="{{ route('user.edit', ['user' => $row]) }}" /> --}}
                <x-button-show href="{{ route('user.show', ['user' => $row]) }}" />
                <x-button-delete url="{{ url('user/'.$row->id) }}" />
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
        <div class="row">
            <div class="col-md-6">
                <x-input type="text" name="nom" place="le nom de la structure" />
            </div>
            <div class="col-md-6">
                <x-input type="text" name="contact" place="le contact de la structure" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-input type="email" name="email" place="email de la structure" />
            </div>
            <div class="col-md-6">
                <x-input type="file" name="logo" label="Logo Faculatif" :required='false' />
            </div>
        </div>
        <x-input type="text" name="adresse" place="l'adresse de la structure" />
        <x-textarea :required='false' place="Fait une description de l'organisation ou de la structure"
            name="description" label="description de la structure Faculatif" />
    </x-form>
</x-modal>
@endsection