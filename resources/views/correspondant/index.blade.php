@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">correspondant</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des correspondants de courrier</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter url="correspondant" :create="App\Models\Correspondant::class" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Structure</th>
            <th>Nom</th>
            <th>Fonction</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Date de creation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->fonction }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->contact }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit :row="$row" href="{{ route('correspondant.edit', ['correspondant' => $row]) }}" />
                <x-button-show :row="$row" href="{{ route('correspondant.show', ['correspondant' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('correspondant/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>

<x-modal title="nouveaux correspondant">
    <x-form route="{{ route('correspondant.store') }}">
        <div class="col-md-6">
            <x-input type="text" name="nom" place="le nom du correspondant" />
        </div>
        <div class="col-md-6">
            <x-input type="text" name="fonction" place="la fonction du correspondant" />
        </div>
        <div class="col-md-6">
            <x-input type="text" name="contact" :required="false" label="contact facultatif"
                place="le contact du correspondant" />
        </div>
        <div class="col-md-6">
            <x-input type="email" name="email" place="l'email du correspondant" />
        </div>
        @if(Auth::user()->isSuperadmin())
        <x-select name='structure_id' label="structure">
            @foreach ($structure as $row)
            <option value="{{ $row->id }}">{{ $row->nom }}</option>
            @endforeach
        </x-select>
        @else
        <input type="hidden" value="{{ Auth::user()->structure() }}" name="structure_id">
        @endif

    </x-form>
</x-modal>
@endsection