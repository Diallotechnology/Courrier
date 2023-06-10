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
            <x-filter :create="false" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>structure</th>
            <th>date expiration</th>
            <th>Code</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>

            <td>{{ $row->id }}</td>
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->date_expiration }}</td>
            <td>{{ $row->code }}</td>
            <td>
                <span @class(['status', 'status-success'=> $row->active == 1, 'status-red'=> $row->active == 0,])>
                    <span class="status-dot status-dot-animated"></span>
                    {{ $row->active == 1 ? 'Active' : 'Expire' }}

                </span>
            </td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-delete :row="$row" url="{{ url('licence/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
@endsection
