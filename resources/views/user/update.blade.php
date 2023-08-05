@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-10 mx-auto">
        <div class="card p-3">
            <x-form route="{{ route('user.update',$user) }}" type="update" url="{{ route('user') }}">
                <input type="hidden" name="type">
                <div class="col-md-6">
                    <x-input type="text" name="name" :value="$user->name" label="Nom complet"
                        place="le nom et prenom de l'utilisateur" />
                </div>

                <div class="col-md-6">
                    <x-input type="text" name="poste" :value="$user->poste" place="le poste de l'utilisateur" />
                </div>

                <div class="col-md-6">
                    <x-input type="email" name="email" :value="$user->email" place="email de l'utilisateur" />
                </div>
                <div class="col-md-6">
                    <x-select name="sexe" label="Sexe">
                      <option @selected($user->sexe === "Homme") value="Homme">Homme</option>
                      <option @selected($user->sexe === "Femme") value="Femme">Fomme</option>
                    </x-select>
                </div>

                @if(Auth::user()->isSuperuser())
                <input type="hidden" name="userable_id" value="{{ Auth::user()->userable_id }}">
                @else
                <div class="col-md-12">
                    <x-select name="type" label="Cet utilisateur appartient a un departement ou sous departement">
                        <option @selected($user->userable_type === "App\Models\Departement")
                            value="departement">departement</option>
                        <option @selected($user->userable_type === "App\Models\SubDepartement")
                            value="subdepartement">sous departement</option>
                    </x-select>
                </div>
                <div class="col-md-12">
                    <x-select name="userable_id" label="Departement">
                        @foreach ($departement as $row)
                        <option @selected($user->UserDepartement() && $user->userable_id == $row->id) value="{{ $row->id
                            }}">
                            Departement {{ $row->nom }}
                        </option>
                        @foreach ($row->subdepartements as $item)
                        <option @selected($user->UserSubDepartement() && $user->userable_id == $item->id) value="{{
                            $item->id }}">
                            Sous departement {{ $item->nom }}
                        </option>
                        @endforeach
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-12">
                    <x-select name="role" label="Role/Droit d'access">
                        @foreach (App\Enum\RoleEnum::cases() as $row)
                        @continue(!Auth::user()->isSuperuser() and $loop->first)
                        <option @selected($user->role === $row) value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>
                </div>
                <h3>les departements aux quelles ce compte est autorisé a imputé un courrier Facultatif</h3>
                <div class="col-md-6">
                    <x-select name="departement_id[]" :required="false" multiple label="Departement">
                        @foreach ($departement as $row)
                        <option @selected($user->departements->where('pivot.type','division')
                            ->contains('id',$row->id)) value="{{ $row->id }}">
                            {{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select name="subdepartement_id[]" :required="false" multiple label="sous Departement">
                        @foreach ($departement as $row)
                        @foreach ($row->subdepartements as $item)
                        <option @selected($user->departements->where('pivot.type','sub_division')
                            ->contains('id',$item->id)) value="{{ $item->id }}">
                            {{ $item->nom }}
                        </option>
                        @endforeach
                        @endforeach
                    </x-select>
                </div>
                @endif
            </x-form>
        </div>
    </div>
</div>
@endsection
