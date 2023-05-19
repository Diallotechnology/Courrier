@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Corbeille des imputations</h3>
        </div>
        <div class="card-body">

            <x-filter trash="imputation" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Reference</th>
            <th>N° du courrier</th>
            <th>Nom du departement</th>
            <th>Priorité</th>
            <th>Etat</th>
            <th>Delai</th>
            <th>Fin de traitement</th>
            <th>Date de creation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->reference }}</td>
            <td>{{ $row->courrier ? $row->courrier->numero : 'inexistant' }}</td>
            <td>{{ $row->departement ? $row->departement->nom : 'inexistant' }}</td>
            <td>
                <x-statut type="prio" :courrier="$row" />
            </td>
            <td>
                <x-statut-imputation :row="$row" />
            </td>
            <td>{{ $row->delai }}</td>
            <td>{{ $row->fin_traitement }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore url="{{ url('imputation/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('imputation/delete/'.$row->id) }}" />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="11">
                <h2 class="text-center">Aucun element</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>
@endsection