@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Sous Departement</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des sous departements</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows" url="subdepartement" :create="App\Models\SubDepartement::class">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'un sous departement entrainera la suppression de ses utlisateurs
            </h3>
        </div>
    </x-slot>

    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>departement</th>
            <th>Code</th>
            <th>Utilisateurs</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->nom }}</td>
            <td>{{ $row->departement ? $row->departement->nom : 'inexistant' }}</td>
            <td>{{ $row->code }}</td>
            <td>{{ $row->users_count }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit :row="$row" href="{{ route('subdepartement.edit', ['subdepartement' => $row]) }}" />
                <x-button-show :row="$row" href="{{ route('subdepartement.show', ['subdepartement' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('subdepartement/'.$row->id) }}" />
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
<x-modal title="nouveaux sous departement">
    <x-form route="{{ route('subdepartement.store') }}">
        <x-input type="text" name="nom" place="le nom du sous departement" />
        <x-input type="text" name="code" place="le code du sous departement" />
        <x-select name='departement_id' label="departement">
            @foreach ($departement as $row)
            <option @selected(old('departement_id')==$row->id) value="{{ $row->id }}">{{ $row->nom }}</option>
            @endforeach
        </x-select>
    </x-form>
</x-modal>

<x-modal lancher="user" title="nouveaux utilisateur">
    <x-form route="{{ route('user.store') }}">
        <input type="hidden" value="subdepartement" name="type">
        <div class="col-md-6">
            <x-input type="text" name="name" label="Nom complet" place="le nom et prenom de l'utilisateur" />
        </div>

        <div class="col-md-6">
            <x-input type="text" name="poste" place="le poste de l'utilisateur" />
        </div>

        <div class="col-md-12">
            <x-input type="email" name="email" place="email de l'utilisateur" />
        </div>

        @if(Auth::user()->isSuperuser())
        <input type="hidden" name="userable_id" value="{{ Auth::user()->userable_id }}">
        @else
        <div class="col-md-12">
            <x-select name="userable_id" label="Sous Departement">
                @foreach ($sub as $row)
                <option @selected(old('userable_id')==$row->id) value="{{ $row->id }}">{{ $row->nom }}</option>
                @endforeach
            </x-select>
        </div>
        @endif
        <div class="col-md-12">
            <x-select name="role" label="Role/Droit d'access">
                @foreach (App\Enum\RoleEnum::cases() as $row)
                @continue(!Auth::user()->isSuperuser() and $loop->first)
                <option value="{{ $row }}">{{ $row }}</option>
                @endforeach
            </x-select>
        </div>
    </x-form>
</x-modal>
@endsection