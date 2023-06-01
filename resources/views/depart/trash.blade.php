@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Courrier depart</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des courriers depart</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter trash="depart" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Structure</th>
            <th>Nature</th>
            <th>Correspondant</th>
            <th>Reference</th>
            <th>En Reponse</th>
            <th>Priorite</th>
            <th>Confidential</th>
            <th>Numero/Date depart</th>
            <th>Etat</th>
            <th>Objet</th>
            <th>Date</th>
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
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->nature ? $row->nature->nom : 'inexistant' }}</td>
            <td>
                {{ $row->correspondant ? $row->correspondant->nom : 'inexistant' }}
            </td>
            <td>{{ $row->reference }}</td>
            <td>{{ $row->courrier ? 'Courrier arriver N°'. $row->courrier->numero : 'pas de response' }}</td>

            <td>
                <x-statut type="prio" :courrier="$row" />
            </td>
            <td>
                <x-statut type="privacy" :courrier="$row" />
            </td>
            <td>
                <div class="d-flex py-1 align-items-center">
                    <div class="flex-fill">
                        <div class="font-weight-medium">N° {{ $row->numero }}</div>
                        <div class="text-muted">Date {{ $row->date_format }}</div>
                    </div>
                </div>
            </td>
            <td>
                <span @class(['status status-success'])>
                    {{ $row->etat }}
                </span>
            </td>
            <td>
                <p class="text-muted">{{ $row->objet }}</p>
            </td>
            <td>{{ $row->deleted_at }}</td>
            <td>

                <x-button-restore url="{{ url('depart/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('depart/delete/'.$row->id) }}" />
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
@endsection