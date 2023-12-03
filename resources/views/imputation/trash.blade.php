@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Imputation</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des imputations de courrier</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" trash="imputation" :create="false">
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Reference</th>
            <th>N/A du courrier</th>
            <th>Departement concerné</th>
            <th>Sous Departement</th>
            <th>Priorité</th>
            <th>Etat</th>
            <th>Delai</th>
            <th>Fin de traitement</th>
            <th>Date de suppression</th>
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
            <td>{{ $row->numero }}</td>
            <td>{{ $row->courrier ? $row->courrier->numero : 'inexistant' }}</td>
            <td>
                @forelse ($row->departements as $item)
                <div>{{ $item->nom }}</div>
                @empty
                aucun
                @endforelse
            </td>
            <td>
                @forelse ($row->subdepartements as $item)
                <div>{{ $item->nom }}</div>
                @empty
                aucun
                @endforelse
            </td>
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
                <x-button-restore :row="$row" url="{{ url('imputation/restore/'.$row->id) }}" />
                @can('forceDelete')
                <x-button-delete :row="$row" url="{{ url('imputation/delete/'.$row->id) }}" />
                @endcan
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