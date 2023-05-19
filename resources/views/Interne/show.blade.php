@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations du courrier interne N° {{ $interne->reference }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Reference</div>
                <div class="datagrid-content">{{ $interne->reference }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Destinataire du courrier</div>
                <div class="datagrid-content">{{ $interne->destinataire->name }}</div>
                <div class="datagrid-content">{{ $interne->destinataire->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Expéditeur du courrier</div>
                <div class="datagrid-content">{{ $interne->expediteur->name }}</div>
                <div class="datagrid-content">{{ $interne->expediteur->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Nature du courrier</div>
                <div class="datagrid-content">{{ $interne->nature->nom }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Priorite</div>
                <div class="datagrid-content">
                    <x-statut type="prio" :courrier="$interne" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Confidentiel</div>
                <div class="datagrid-content">
                    <x-statut type="privacy" :courrier="$interne" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Etat du courrier</div>
                <div class="datagrid-content">
                    <span @class(['status', 'status-success'=> $interne->Send(), 'status-red' => $interne->Recu()])>
                        <span class="status-dot status-dot-animated"></span>
                        {{ $interne->etat }}
                    </span>

                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date d'envoi</div>
                <div class="datagrid-content">{{ $interne->created_at }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Objet</div>
                <div class="datagrid-content">{{ $interne->objet }}</div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    @foreach ($interne->documents as $row)
    <div class="col-md-3">
        <x-card-document :row="$row" />
    </div>
    @endforeach
</div>
@endsection