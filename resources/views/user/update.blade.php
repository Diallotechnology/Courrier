@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-8 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('user.update',$user) }}" type="update" url="{{ route('user') }}">
                <div class="col-md-6">
                    <x-input type="text" name="name" :value="$user->name" label="Nom complet"
                        place="le nom et prenom de l'utilisateur" />
                </div>

                <div class="col-md-6">
                    <x-input type="text" name="poste" :value="$user->poste" place="le poste de l'utilisateur" />
                </div>

                <div class="col-md-12">
                    <x-input type="email" name="email" :value="$user->email" place="email de l'utilisateur" />
                </div>

                <div class="col-md-12">
                    <x-select name="departement_id" label="Departement">
                        @foreach ($departement as $row)
                        <option @selected($user->userable_id == $row->id) value="{{ $row->id }}">{{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-12">
                    <x-select name="role" label="Role/Droit d'access">
                        @foreach (App\Enum\RoleEnum::cases() as $row)
                        <option @selected($user->role === $row) value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection