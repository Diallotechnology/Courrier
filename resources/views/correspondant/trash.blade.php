@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Corbeille des correspondants</h3>
        </div>
        <div class="card-body">

            <x-filter trash="correspondant" :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Prenom</th>
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
            <td>{{ $row->prenom }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->fonction }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->contact }}</td>
            <td>{{ $row->deleted_at }}</td>
            <td>
                <x-button-restore url="{{ url('correspondant/restore/'.$row->id) }}" />
                <x-button-delete url="{{ url('correspondant/delete/'.$row->id) }}" />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">
                <h2 class="text-center">Aucun element</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>
@endsection