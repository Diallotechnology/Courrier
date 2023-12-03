@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">pricing</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des prix</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" :create="App\Models\Price::class">
    <thead>
        <tr>
            <th>ID</th>
            <th>type</th>
            <th>temps</th>
            <th>Montant</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->type }}</td>
            <td>{{ $row->temps }} mois</td>
            <td>{{ $row->montant }} CFA</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit :row="$row" href="{{ route('price.edit', ['price' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('price/'.$row->id) }}" />
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table>
<x-modal title="nouveaux prix">
    <x-form route="{{ route('price.store') }}">
        <div class="col-md-12">
            <x-select name="type" label="type de structure">
                @foreach (App\Enum\StructureTypeEnum::cases() as $row)
                <option value="{{ $row }}">{{ $row }}</option>
                @endforeach
            </x-select>
        </div>
        <div class="col-md-12">
            <x-select name="temps" label="temps">
                <option value="3">3 mois</option>
                <option value="6">6 mois</option>
                <option value="12">1 an</option>
            </x-select>
        </div>
        <div class="col-md-12">
            <x-input type="number" name="montant" place="le  montant" />
        </div>
    </x-form>
</x-modal>
@endsection