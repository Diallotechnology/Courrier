@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des natures de courrier</h3>
        </div>
        <div class="card-body">
            <x-filter url="nature" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit href="{{ route('nature.edit', ['nature' => $row]) }}" />
                <x-button-delete url="{{ url('nature/'.$row->id) }}" />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                <h2 class="text-center">Aucun element</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>
<x-modal title="nouveaux nature">
    <x-form route="{{ route('nature.store') }}">
        <x-input type="text" name="nom" place="le nom de la nature" />
    </x-form>
</x-modal>
@endsection