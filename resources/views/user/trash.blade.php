@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Utlisateur</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des utlisateurs</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter trash="user" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Sexe</th>
            <th>Poste</th>
            <th>Department</th>
            <th>Role</th>
            <th>Date de suppression</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->name }}')">
                        <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true])></span>
                    </span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}</a></div>
                    </div>
                </div>
            </td>
            <td>{{ $row->sexe }}</td>
            <td>{{ $row->poste }}</td>
            <td data-label="Title">
                <div> {{ $row->userable->nom }}</div>
                <div class="text-muted">{{ $row->imputations_count }} Imputations</div>
            </td>
            <td>{{ $row->role }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore :row="$row" url="{{ url('user/restore/'.$row->id) }}" />
                @can('forceDelete')
                <x-button-delete :row="$row" url="{{ url('user/delete/'.$row->id) }}" />
                @endcan
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
