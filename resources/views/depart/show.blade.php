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
                <div class="datagrid-title">Numero d'depart</div>
                <div class="datagrid-content">{{ $depart->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date d'depart</div>
                <div class="datagrid-content">{{ $depart->date }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Correspondant du courrier</div>
                <div class="datagrid-content">{{ $depart->correspondant->prenom }} {{ $depart->correspondant->nom }}
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
<div class="col-md-3">
    <div class="card text-center mb-2 shadow">
        <div class="card-body file">
            <div class="file-action">
                <a target="_blank" href="" role="button" class="btn btn-sm btn-green-1"><i class="ti ti-eye"></i></a>
                <a href="" role="button" class="btn btn-sm btn-primary"><i class="ti ti-edit"></i></a>
            </div>
            <div class="circle circle-lg bg-light my-4">
                <span class="ti ti-file text-success"></span>
            </div>
            <div class="file-info">
                <span class="badge bg-blue badge-pill text-muted">PDF</span>
            </div>
        </div> <!-- .card-body -->
        <div class="card-footer bg-transparent border-0 fname">
            <strong>kddkk</strong> <br>
            <strong>crée: jdddj</strong>
        </div> <!-- .card-footer -->
    </div> <!-- .card -->
</div>

<style>
    .file,
    .file-list {
        position: relative;
    }

    .file .file-info,
    .file .file-action,
    .file-list .file-info,
    .file-list .file-action {
        position: absolute;
        display: none;
    }

    .file .file-info,
    .file-list .file-info {
        bottom: 0.5rem;
        left: 0;
        right: 0;
        display: inline;
    }

    .file .file-action,
    .file-list .file-action {
        top: 0.5rem;
        right: 0.5rem;
    }

    .file:hover,
    .file-list:hover {
        cursor: pointer;
    }

    .file:hover .file-action,
    .file-list:hover .file-action {
        display: inline;
    }
</style>
@endsection