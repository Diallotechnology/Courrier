@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Utilisateur</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Liste des utilisateurs</span>
    </h2>
</div>
@endsection
@section('content')
<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'un utilisateur entrainera la suppression de ses courriers et imputations
            </h3>
        </div>
        <div class="card-body border-bottom py-3">
            <x-filter url="user" :create="App\Models\User::class" />
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Sexe</th>
            <th>Poste</th>
            <th>Department</th>
            <th>Role</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->name }}')">
                        <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true])></span>
                    </span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}</a></div>
                    </div>
                </div>
            </td>
            <td>{{ $row->sexe }}</td>
            <td>{{ $row->poste }}</td>
            <td data-label="Title">
                <div> {{ $row->userable->nom }}</div>
                <div class="text-muted">{{ $row->imputations_count }} Imputations</div>
            </td>
            <td>{{ $row->role }}</td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit :row="$row" href="{{ route('user.edit', ['user' => $row]) }}" />
                <x-button-show :row="$row" href="{{ route('user.show', ['user' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('user/'.$row->id) }}" />
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

<x-modal title="nouveaux utilisateur">
    <x-form route="{{ route('user.store') }}">
        <input type="hidden" value="departement" name="type">
        <div class="col-md-6">
            <x-input type="text" name="name" label="Nom complet" place="le nom et prenom de l'utilisateur" />
        </div>

        <div class="col-md-6">
            <x-input type="text" name="poste" place="le poste de l'utilisateur" />
        </div>

        <div class="col-md-6">
            <x-input type="email" name="email" place="email de l'utilisateur" />
        </div>
        <div class="col-md-6">
            <x-select name="sexe" label="Sexe">
              <option value="Homme">Homme</option>
              <option value="Femme">Fomme</option>
            </x-select>
        </div>

        @if(Auth::user()->isSuperuser())
        <input type="hidden" name="userable_id" value="{{ Auth::user()->userable_id }}">
        <input type="hidden" name="role" value="Standard">
        @else
        <div class="col-md-12">
            <x-select name="userable_id" label="Departement">
                @foreach ($departement as $row)
                <option @selected(old('userable_id')==$row->id) value="{{ $row->id }}">{{ $row->nom }}</option>
                @endforeach
            </x-select>
        </div>
        <div class="col-md-12">
            <x-select name="role" label="Role/Droit d'access">
                @foreach (App\Enum\RoleEnum::cases() as $row)
                @continue(!Auth::user()->isSuperuser() and $loop->first)
                <option value="{{ $row }}">{{ $row }}</option>
                @endforeach
            </x-select>
        </div>

        <h3>les départements auxquels ce compte peut imputer du courrier. Facultatif</h3>
        <div class="col-md-6">
            <x-select name="departement_id[]" :required="false" multiple label="Departement">
                @foreach ($departement as $row)
                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                @endforeach
            </x-select>
        </div>
        <div class="col-md-6">
            <x-select name="subdepartement_id[]" :required="false" multiple label="sous Departement">
                @foreach ($departement as $row)
                @foreach ($row->subdepartements as $item)
                <option value="{{ $item->id }}">{{ $item->nom }}</option>
                @endforeach
                @endforeach
            </x-select>
        </div>
        @endif
    </x-form>
</x-modal>
@endsection
