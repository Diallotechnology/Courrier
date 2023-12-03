@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">correspondant</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des correspondants de courrier</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" trash="correspondant" :create="false">
    <thead>
        <tr>
            <th>ID</th>
            <th>Structure</th>
            <th>Nom</th>
            <th>Fonction</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Date de suppression</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->structure_view() }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->fonction }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->contact }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore :row="$row" url="{{ url('correspondant/restore/'.$row->id) }}" />
                @can('forceDelete')
                <x-button-delete :row="$row" url="{{ url('correspondant/delete/'.$row->id) }}" />
                @endcan
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