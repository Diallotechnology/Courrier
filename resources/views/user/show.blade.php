@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="container">
        <div class="card">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="avatar avatar-xl rounded"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $user->name }}')"></span>
                </div>
                <div class="col">
                    <h2 class="fw-bold">{{ $user->name }}</h2>
                    <h4 class="fw-bold">Email: {{ $user->email }}</h4>
                    <h4 class="fw-bold">Departement: {{ $user->departement->nom }}</h4>
                    <h4 class="fw-bold">Poste: {{ $user->poste }}</h4>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row mx-1 my-3">
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down-left"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 7l-10 10"></path>
                                <path d="M16 17l-9 0l0 -9"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Total Courrier arrivé
                        </div>
                        <div class="text-muted">
                            {{ count($user->courriers) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-diff"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M11 16h10"></path>
                                <path d="M11 16l4 4"></path>
                                <path d="M11 16l4 -4"></path>
                                <path d="M13 8h-10"></path>
                                <path d="M13 8l-4 4"></path>
                                <path d="M13 8l-4 -4"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Total Courrier internes
                        </div>
                        <div class="text-muted">
                            Envoyé {{ count(Auth::user()->expediteurs) }}
                            Reçu {{ count(Auth::user()->destinataires) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up-right"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 7l-10 10"></path>
                                <path d="M8 7l9 0l0 9"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Total Courrier départ
                        </div>
                        <div class="text-muted">
                            {{ count($user->departs) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-share"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M8.7 10.7l6.6 -3.4"></path>
                                <path d="M8.7 13.3l6.6 3.4"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Total Imputations
                        </div>
                        <div class="text-muted">
                            {{ count($user->imputations) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mx-1 my-3">
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-report"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 17m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                <path d="M17 13v4h4"></path>
                                <path d="M12 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Totale annotation
                        </div>
                        <div class="text-muted">
                            {{ count($user->annotations) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                                <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2"></path>
                                <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                </path>
                                <path d="M8 11h4"></path>
                                <path d="M8 15h3"></path>
                                <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                                <path d="M18.5 19.5l2.5 2.5"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Total Rapport
                        </div>
                        <div class="text-muted">
                            {{ count($user->rapports) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3.5 5.5l1.5 1.5l2.5 -2.5"></path>
                                <path d="M3.5 11.5l1.5 1.5l2.5 -2.5"></path>
                                <path d="M3.5 17.5l1.5 1.5l2.5 -2.5"></path>
                                <path d="M11 6l9 0"></path>
                                <path d="M11 12l9 0"></path>
                                <path d="M11 18l9 0"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Total Taches
                        </div>
                        <div class="text-muted">
                            {{ count($user->tasks) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-activity"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Total Journalisations
                        </div>
                        <div class="text-muted">
                            {{ count($user->journals) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mx-1 my-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tabs-home-9" class="nav-link active" data-bs-toggle="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-check"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                                <path d="M3 7l9 6l9 -6"></path>
                                <path d="M15 19l2 2l4 -4"></path>
                            </svg>
                            Courrier
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-profile-9" class="nav-link" data-bs-toggle="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-share"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M8.7 10.7l6.6 -3.4"></path>
                                <path d="M8.7 13.3l6.6 3.4"></path>
                            </svg>
                            Imputation
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-home-9">
                        <h4>Historique des courriers arrivé</h4>
                        <div class="table-responsive">
                            <table id="datatable" class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Utilisateur</th>
                                        <th>Nature</th>
                                        <th>Correspondant</th>
                                        <th>Reference</th>
                                        <th>Priorite</th>
                                        <th>Confidential</th>
                                        <th>Numero/Date arriver</th>
                                        <th>Etat</th>
                                        <th>Objet</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user->courriers as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>
                                            <x-user-avatar :row="$row" />
                                        </td>
                                        <td>{{ $row->nature ? $row->nature->nom : 'inexistant' }}</td>
                                        <td>
                                            {{ $row->correspondant ? $row->correspondant->prenom.'
                                            '.$row->correspondant->nom : 'inexistant' }}
                                        </td>
                                        <td>{{ $row->reference }}</td>

                                        <td>
                                            <x-statut type="prio" :courrier="$row" />
                                        </td>
                                        <td>
                                            <x-statut type="privacy" :courrier="$row" />
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">N° {{ $row->numero }}</div>
                                                    <div class="text-muted">Date {{ $row->date_format }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <x-statut type="etat" :courrier="$row" />
                                        </td>
                                        <td>
                                            <p class="text-muted">{{ $row->objet }}</p>
                                        </td>

                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            <x-button-show href="{{ route('arriver.show', ['arriver' => $row]) }}" />
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
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane" id="tabs-profile-9">
                        <h4>Historique des imputations</h4>
                        <div class="table-responsive">
                            <table id="datatable" class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Utilisateur</th>
                                        <th>Reference</th>
                                        <th>N° du courrier</th>
                                        <th>Nom du departement</th>
                                        <th>Priorité</th>
                                        <th>Etat</th>
                                        <th>Delai</th>
                                        <th>Fin de traitement</th>
                                        <th>Date de creation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user->imputations as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>
                                            <x-user-avatar :row="$row" />
                                        </td>
                                        <td>{{ $row->reference }}</td>
                                        <td>{{ $row->courrier ? $row->courrier->numero : 'inexistant' }}</td>
                                        <td>{{ $row->departement ? $row->departement->nom : 'inexistant' }}</td>
                                        <td>
                                            <x-statut type="prio" :courrier="$row" />
                                        </td>
                                        <td>
                                            <x-statut-imputation :row="$row" />
                                        </td>
                                        <td>{{ $row->delai }}</td>
                                        <td>{{ $row->fin_traitement }}</td>

                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            <x-button-show
                                                href="{{ route('imputation.show', ['imputation' => $row]) }}" />

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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection