@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">licence</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des licences</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter :create="App\Models\Licence::class" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>structure</th>
            <th>temps</th>
            <th>type</th>
            <th>debut</th>
            <th>fin</th>
            <th>Code</th>
            <th>Etat</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->temps }}</td>
            <td>{{ $row->version }}</td>
            <td>{{ $row->debut }}</td>
            <td>{{ $row->fin }}</td>
            <td>{{ $row->code }}</td>
            <td>
                <span @class(['status', 'status-success'=> $row->active == 1, 'status-red'=> $row->active == 0,])>
                    <span class="status-dot status-dot-animated"></span>
                    {{ $row->active == 1 ? 'Active' : 'Expire' }}

                </span>
            </td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-show :row="$row" href="{{ route('licence.show', ['licence' => $row]) }}" />
                <x-button-edit :row="$row" href="{{ route('licence.edit', ['licence' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('licence/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
<x-modal title="nouvelle licence">
    <div wire:ignore>
        <x-form route="{{ route('licence.store') }}">
            <div class="col-md-12">
                <x-select name="structure_id" label="liste des structures">
                    @foreach ($structure as $row)
                    <option value="{{ $row->id }}">{{ $row->nom }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-12">
                <x-select name="version" label="type de licence">
                    @foreach (App\Enum\LicenceEnum::cases() as $row)
                    <option value="{{ $row }}">{{ $row }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-12">
                <x-select name="temps" label="temps">
                    <option value="6">6 mois</option>
                    <option value="12">1 an</option>
                </x-select>
            </div>
        </x-form>
    </div>
</x-modal>
@endsection