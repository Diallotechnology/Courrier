@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Corbeille des structures</h3>
        </div>
        <div class="card-body">

            <x-filter trash="structure" :create="false" />
        </div>
    </x-slot>
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
                <x-button-restore url="{{ url('structure/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('structure/delete/'.$row->id) }}" />
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