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
                <div class="datagrid-title">Expéditeur du courrier</div>
                <div class="datagrid-content">
                    <div class="d-flex py-1 align-items-center">
                        <span class="avatar me-2"
                            style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $interne->expediteur->name }}')"></span>
                        <div class="flex-fill">
                            <div class="font-weight-medium">{{ $interne->expediteur->name }}</div>
                            <div class="text-muted"><a href="#" class="text-reset">{{ $interne->expediteur->email
                                    }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Destinataire du courrier</div>
                <div class="datagrid-content">
                    <div class="d-flex py-1 align-items-center">
                        <span class="avatar me-2"
                            style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $interne->destinataire->name }}')"></span>
                        <div class="flex-fill">
                            <div class="font-weight-medium">{{ $interne->destinataire->name }}</div>
                            <div class="text-muted"><a href="#" class="text-reset">{{ $interne->destinataire->email
                                    }}</a></div>
                        </div>
                    </div>
                </div>
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
@empty(!$interne->contenu)
<div class="card card-lg">
    <div class="card-body markdown">
        <h2 class="text-center m-3">Contenu du courrier</h2>
        {!! $interne->contenu !!}
    </div>
</div>
@endempty
<div class="row mt-2">
    @foreach ($interne->documents as $row)
    <div class="col-md-3">
        <x-card-document :row="$row" />
    </div>
    @endforeach
</div>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Discussion du courrier interne N° {{ $interne->numero }}</h3>
        </div>
        <div class="list-group list-group-flush overflow-auto" style="max-height: 35rem">
            @forelse ($interne->reponses as $row)
            <div class="list-group-item">
                <div class="row">
                    <div class="col-auto">
                        <a href="#">
                            <span class="avatar"
                                style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{  $row->user->name }}')"></span>
                        </a>
                    </div>
                    <div class="col text-truncate">
                        <a href="#" class="text-body d-block">{{ $row->user->name }} Departement {{
                            $row->user->userable->nom }}</a>
                        <div class="text-muted text-truncate mt-n1">{{ $row->message }}</div>
                        <div class="text-muted text-truncate mt-n1">{{ $row->created_at }}</div>

                    </div>
                    <div class="col-auto">
                        <x-button-edit href="{{ route('reponse.edit', ['reponse' => $row]) }}" />
                        <x-button-delete url="{{ url('reponse/'.$row->id) }}" />
                    </div>
                </div>
            </div>
            @empty
            <h2 class="text-center py-2">Aucune reponse pour ce courrier</h2>
            @endforelse
        </div>
    </div>
</div>
<div class="card p-3">
    <form novalidate action="{{ route('reponse.store') }}" class="needs-validation" method="post">
        @csrf
        <input type="hidden" value="{{ $interne->id }}" name="interne_id">
        <input type="hidden" value="{{ $interne->expediteur_id }}" name="expediteur_id">
        <div class="col-12">
            <div class="mb-3">
                <label for="message" class="form-label text-uppercase">Votre
                    reponse</label>
                <textarea required name="message" id="message" class="form-control" rows="6"
                    placeholder="Entrer votre reponse au courrier"></textarea>
            </div>
            <div class="valid-feedback"></div>
            <div class="invalid-feedback">Ce champ est obligatoire.</div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit">Envoyé</button>
        </div>
    </form>

</div>
@endsection