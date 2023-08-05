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
            <th>Structure</th>
            <th>Utilisateur</th>
            <th>Numero depart</th>
            <th>Initiateur</th>
            <th>Date depart</th>
            <th>Nature</th>
            <th>Correspondant</th>
            <th>En Reponse</th>
            <th>Priorite</th>
            <th>Confidential</th>
            <th>Etat</th>
            <th>Objet</th>
            <th>Date de suppression</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->structure_view() }}</td>
            <td><x-user-avatar :row="$row" /></td>
            <td>{{ $row->numero }}</td>
            <td>
                @if($row->initiateur)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->initiateur->name }}')"></span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->initiateur->name }}</div>
                        <div class="text-muted">
                            <p class="text-reset">{{ $row->initiateur->email }}</p>
                        </div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>
            <td>
                {{ $row->date_format }}
            </td>
            <td>{{ $row->nature_view() }}</td>
            <td>
                @forelse ($row->correspondants as $item)
                <div> {{ $item->nom }}</div>
                @empty
                aucun
                @endforelse
            </td>

            <td>{{ $row->courrier ? 'Courrier N°'. $row->courrier->numero : 'pas de reponse' }}</td>

            <td>
                <x-statut type="prio" :courrier="$row" />
            </td>
            <td>
                <x-statut type="privacy" :courrier="$row" />
            </td>
            <td>
                <span @class(['status status-success'])>{{ $row->etat }}</span>
            </td>
            <td>
                <p class="text-muted">{{ $row->objet }}</p>
            </td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore :row="$row" url="{{ url('depart/restore/'.$row->id) }}" />
                <x-button-delete :row="$row" url="{{ url('depart/delete/'.$row->id) }}" />
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
