@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Structure</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des structures</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" trash="structure" :create="false">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Total department</th>
            <th>Date de suppression</th>
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
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore :row="$row" url="{{ url('structure/restore/'.$row->id) }}" />
                @can('forceDelete')
                <x-button-delete :row="$row" url="{{ url('structure/delete/'.$row->id) }}" />
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