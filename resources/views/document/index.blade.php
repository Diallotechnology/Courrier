@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Document</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des documents</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter url="document" :create="App\Models\Document::class" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Libelle</th>
            <th>type</th>
            <th>Date de creation</th>
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
            <td>{{ $row->libelle }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit :row="$row" href="{{ route('document.edit', ['document' => $row]) }}" />
                <x-button-show :row="$row" href="{{ route('document.show', ['document' => $row]) }}" target="_blank" />
                <x-button-delete :row="$row" url="{{ url('document/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection