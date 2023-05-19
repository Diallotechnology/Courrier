@extends('layouts.app')
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Liste des documents</h3>
        </div>
        <div class="card-body">
            <x-filter url="document" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>Courrier reference</th>
            <th>type courrier</th>
            <th>Chemin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->libelle }}</td>
            <td>{{ $row->documentable ? $row->documentable->reference : 'inexistant' }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->chemin }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit href="{{ route('document.edit', ['document' => $row]) }}" />
                <x-button-show href="{{ route('document.show', ['document' => $row]) }}" target="_blank" />
                <x-button-delete url="{{ url('document/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>

<x-modal title="nouveaux document">
    <x-form route="{{ route('document.store') }}" enctype="multipart/form-data">
        <div class="col-md-6">
            <x-input type="text" name="libelle" place="libelle du document" />
        </div>
        <div class="col-md-6">
            <x-input type="file" multiple name="document" label='Piece jointes ou fichiers PDF' />
        </div>
        <x-select name='type'>
            <option value="Arrivé">Arrivé</option>
            <option value="Depart">Depart</option>
            <option value="Interne">Interne</option>
        </x-select>
        {{-- <x-select name='structure_id'>
            @foreach ($courrier as $row)
            <option value="{{ $row->id }}">Courrier N°{{ $row->reference }}</option>
            @endforeach
        </x-select> --}}
    </x-form>
</x-modal>
@endsection