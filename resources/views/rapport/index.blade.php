@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Rapport</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des rapport ou compte rendu</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter url="rapport" :create="false" :btn_filter="false">
                <x-slot name="btn">
                    <a href="{{ route('rapport.create') }}" class="btn btn-primary mx-2" role="button">
                        <i class="ti ti-plus"></i>
                        Nouveau
                    </a>
                </x-slot>
            </x-filter>
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>reference</th>
            <th>type</th>
            <th>objet</th>
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
            <td>{{ $row->reference }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->objet }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit href="{{ route('rapport.edit', ['rapport' => $row]) }}" />
                <x-button-show href="{{ route('rapport.show', ['rapport' => $row]) }}" />
                <x-button-delete url="{{ url('rapport/'.$row->id) }}" />
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