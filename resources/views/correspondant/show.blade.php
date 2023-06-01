@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations du correspondant</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nom</div>
                <div class="datagrid-content">{{ $correspondant->nom }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $correspondant->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Contact</div>
                <div class="datagrid-content">{{ $correspondant->contact }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Fonction</div>
                <div class="datagrid-content">{{ $correspondant->fonction }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $correspondant->created_at }}</div>
            </div>
        </div>
    </div>
</div>
<x-table>
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Historique de courrier</h3>
        </div>
        <div class="card-body">
            <x-filter :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Nature</th>
            <th>Correspondant</th>
            <th>Reference</th>
            <th>Priorite</th>
            <th>Confidential</th>
            <th>Numero/Date arriver</th>
            <th>Etat</th>
            <th>Objet</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($correspondant->courriers as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->nature ? $row->nature->nom : 'inexistant' }}</td>
            <td>
                {{ $row->correspondant ? $row->correspondant->nom : 'inexistant' }}
            </td>
            <td>{{ $row->reference }}</td>

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
                <x-statut type="etat" :courrier="$row" />
            </td>
            <td>
                <p class="text-muted">{{ $row->objet }}</p>
            </td>

            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-show href="{{ route('arriver.show', ['arriver' => $row]) }}" />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10">
                <h2 class="text-center">Aucun element</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>
@endsection