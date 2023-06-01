@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations du courrier depart N° {{ $depart->numero }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Reference</div>
                <div class="datagrid-content">{{ $depart->reference }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Numero depart</div>
                <div class="datagrid-content">{{ $depart->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date depart</div>
                <div class="datagrid-content">{{ $depart->date }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Correspondant du courrier</div>
                <div class="datagrid-content">{{ $depart->correspondant->nom }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Nature du courrier</div>
                <div class="datagrid-content">{{ $depart->nature->nom }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Priorite</div>
                <div class="datagrid-content">
                    <x-statut type="prio" :courrier="$depart" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Confidentiel</div>
                <div class="datagrid-content">
                    <x-statut type="privacy" :courrier="$depart" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">En reponse d'un courrier arriver</div>
                <div class="datagrid-content">
                    {{ $depart->courrier ? 'N°'. $depart->courrier->numero : 'pas de response' }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Etat du courrier</div>
                <div class="datagrid-content">
                    <span @class(['status status-success'])>
                        {{ $depart->etat }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $depart->created_at }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Objet</div>
                <div class="datagrid-content">{{ $depart->objet }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Observation et Commentaire</div>
                <div class="datagrid-content">{{ $depart->observation }}</div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    @foreach ($depart->documents as $row)
    <div class="col-md-3">
        <x-card-document :row="$row" />
    </div>
    @endforeach
</div>

@endsection