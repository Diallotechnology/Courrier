@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations de la licence N° {{ $licence->id }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Structure</div>
                <div class="datagrid-content">{{ $licence->structure->nom }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Type de licence</div>
                <div class="datagrid-content">{{ $licence->version }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Temps</div>
                <div class="datagrid-content">{{ $licence->temps }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Debut</div>
                <div class="datagrid-content">{{ $licence->debut }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Fin</div>
                <div class="datagrid-content">{{ $licence->fin }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Clé de licence</div>
                <div class="datagrid-content">{{ $licence->code }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Etat</div>
                <div class="datagrid-content">
                    <span @class(['status', 'status-success'=> $licence->active == 1, 'status-red'=> $licence->active ==
                        0,])>
                        <span class="status-dot status-dot-animated"></span>
                        {{ $licence->active == 1 ? 'Active' : 'Expire' }}

                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $licence->created_at }}</div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="col-12">
        <h2 class="text-center m-3">Renouvelé la licence</h2>
        <x-form route="{{ route('licence.review', $licence) }}" class="m-3">
            @method('patch')
            <div class="col-md-6">
                <x-select name="version" label="type de licence">
                    @foreach (App\Enum\LicenceEnum::cases() as $row)
                    <option @selected($licence->version == $row) value="{{ $row }}">{{ $row }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select name="temps" label="temps">
                    <option @selected($licence->temps == 15) value="6">15 jours</option>
                    <option @selected($licence->temps == 6) value="6">6 mois</option>
                    <option @selected($licence->temps == 12) value="12">1 an</option>
                </x-select>
            </div>
        </x-form>
    </div>
</div>
@endsection