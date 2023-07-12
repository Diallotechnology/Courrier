@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations de imputation N° {{ $imputation->numero }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Reference</div>
                <div class="datagrid-content">{{ $imputation->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Utilisateur</div>
                <div class="datagrid-content">
                    <x-user-avatar :row="$imputation" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Departement concerné</div>
                <div class="datagrid-content">
                    @forelse ($imputation->departements as $item)
                    <div>{{ $item->nom }}</div>
                    @empty
                    aucun
                    @endforelse
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Sous Departement concerné</div>
                <div class="datagrid-content">
                    @forelse ($imputation->subdepartements as $item)
                    <div>{{ $item->nom }}</div>
                    @empty
                    aucun
                    @endforelse
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Priorite</div>
                <div class="datagrid-content">
                    <x-statut type="prio" :courrier="$imputation" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Etat de l'imputation</div>
                <div class="datagrid-content">
                    <x-statut-imputation :row="$imputation" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Delai de traitement</div>
                <div class="datagrid-content">
                    @empty($imputation->delai)
                    Non defini
                    @else
                    {{ $imputation->delai }}
                    @endempty
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de fin traitement</div>
                <div class="datagrid-content">{{ $imputation->fin_traitement }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de l'imputation</div>
                <div class="datagrid-content">{{ $imputation->created_at }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Observation et Commentaire</div>
                <div class="datagrid-content">
                    @empty($imputation->observation)
                    Aucun
                    @else
                    {{ $imputation->observation }}
                    @endempty
                </div>
            </div>

        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des annotations et instructions de imputation</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-content">
                    <div class="row">
                        @foreach ($imputation->annotations as $row)
                        <div class="col-md-4">
                            <label class="form-check">
                                <input class="form-check-input" checked type="checkbox">
                                <span class="form-check-label">{{ $row->nom }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection