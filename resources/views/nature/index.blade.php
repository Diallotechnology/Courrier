@extends('layouts.app')
@section('content')
<x-table>
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des natures de courrier</h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <x-button-modal />

                <div class="ms-auto text-muted">
                    Recherche:
                    <div class="ms-2 d-inline-block">
                        <input type="text" onkeyup="myFunction()" id="myInput" class="form-control form-control-sm"
                            aria-label="Search invoice">
                    </div>
                </div>
            </div>
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
        @foreach ($rows as $row)
        <tr>

            <td>{{ $row->id }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit href="{{ route('nature.edit', ['nature' => $row]) }}" />
                <x-button-delete url="{{ url('nature/'.$row->id) }}" />
            </td>

        </tr>
        @endforeach
    </tbody>
</x-table>
<x-modal title="nouveaux nature">
    <x-form route="{{ route('nature.store') }}">
        <x-input type="text" name="nom" place="le nom de la nature" />
    </x-form>
</x-modal>
@endsection