@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="#">Document</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Corbeille</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Corbeille des documents</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" url="document" :create="false">

    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>nom du Dossier</th>
            <th>Libelle</th>
            <th>extension</th>
            <th>Date de suppression</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->folder->nom }}</td>
            <td>{{ $row->libelle }}</td>
            <td>{{ $row->extension }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore :row="$row" url="{{ url('document/restore/'.$row->id) }}" />
                @can('forceDelete')
                <x-button-delete :row="$row" url="{{ url('document/delete/'.$row->id) }}" />
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection