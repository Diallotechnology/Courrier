@extends('layouts.app')
@section('header')
<div class="col">
    <div class="mb-1">
        <ol class="breadcrumb" aria-label="breadcrumbs">
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Tableau de bord</a></li>
        </ol>
    </div>
    <h2 class="page-title">
        <span class="text-truncate">Tableau de bord</span>
    </h2>
</div>
@endsection
@section('content')
<div class="row row-deck row-cards">
    <div class="col-12">
        <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-down-left" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                                    {{ count(Auth::user()->courriers) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrows-diff" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-up-right" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                                    {{ count(Auth::user()->departs) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-share"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
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
                                    Totale imputation
                                </div>
                                <div class="text-muted">
                                    {{ count(Auth::user()->imputations) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-settings-check" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M11.445 20.913a1.665 1.665 0 0 1 -1.12 -1.23a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.31 .318 1.643 1.79 .997 2.694">
                                        </path>
                                        <path d="M15 19l2 2l4 -4"></path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    Totale Courrier Traité
                                </div>
                                <div class="text-muted">
                                    {{ count(Auth::user()->courriers->where('etat',App\Enum\CourrierEnum::TERMINE)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-file-report" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                                    {{ count(Auth::user()->annotations) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-report-search" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                                        <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2"></path>
                                        <path
                                            d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
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
                                    {{ count(Auth::user()->rapports) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-list-check" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                                    {{ count(Auth::user()->createurs) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-md">
            <div class="card-body px-3 py-2">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h3 class="h1">
                            {{ Auth::user()->name }}
                        </h3>
                        <div class="h4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                                </path>
                                <path d="M3 7l9 6l9 -6"></path>
                            </svg>
                            Email: <strong>{{ Auth::user()->email }}</strong>
                        </div>
                        <div class="h4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-cog"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h1.6"></path>
                                <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4.159"></path>
                                <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M18 14.5v1.5"></path>
                                <path d="M18 20v1.5"></path>
                                <path d="M21.032 16.25l-1.299 .75"></path>
                                <path d="M16.27 19l-1.3 .75"></path>
                                <path d="M14.97 16.25l1.3 .75"></path>
                                <path d="M19.733 19l1.3 .75"></path>
                            </svg>
                            Structure: {{ Auth::user()->user_structure()->nom }}
                        </div>
                        <div class="h4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 21l18 0"></path>
                                <path d="M9 8l1 0"></path>
                                <path d="M9 12l1 0"></path>
                                <path d="M9 16l1 0"></path>
                                <path d="M14 8l1 0"></path>
                                <path d="M14 12l1 0"></path>
                                <path d="M14 16l1 0"></path>
                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                            </svg>
                            Departement: {{ Auth::user()->userable->nom }}
                        </div>
                        <div class="h4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-devices-pc"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 5h6v14h-6z"></path>
                                <path d="M12 9h10v7h-10z"></path>
                                <path d="M14 19h6"></path>
                                <path d="M17 16v3"></path>
                                <path d="M6 13v.01"></path>
                                <path d="M6 16v.01"></path>
                            </svg>
                            Poste: {{ Auth::user()->poste }}
                        </div>
                        <div class="h4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-lock"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3">
                                </path>
                                <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 12l0 2.5"></path>
                            </svg>
                            Role: {{ Auth::user()->role }}
                        </div>

                        <div class="h4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cell-signal-5"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M20 20h-15.269a.731 .731 0 0 1 -.517 -1.249l14.537 -14.537a.731 .731 0 0 1 1.249 .517v15.269z">
                                </path>
                                <path d="M16 7v13"></path>
                                <path d="M12 20v-9"></path>
                                <path d="M8 20v-5"></path>
                            </svg>
                            Etat: <span class="status status-green">
                                <span class="status-dot status-dot-animated"></span>
                            </span> En ligne
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div style="text-align:center;padding:1em 0;">
                            <h3><a style="text-decoration:none;"
                                    href="https://www.zeitverschiebung.net/fr/city/2460596">
                                    <span class="text-dark">Heure actuelle</span><br />Bamako, Mali</a></h3> <iframe
                                src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=fr&size=medium&timezone=Africa%2FBamako"
                                width="100%" height="auto" frameborder="0" seamless></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card" style="height: 17rem">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                            </svg>
                            {{ count(Auth::user()->unreadNotifications) }}
                            Notifications
                        </h3>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            @forelse (Auth::user()->notifications as $row)
                            <div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-truncate">
                                            {{ $row->data['message'] }}
                                        </div>
                                        <div class="text-muted">{{ $row->created_at->locale('fr')->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <div class="badge bg-primary"></div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h2 class="text-center"> Vous avez pas de notifications</h2>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h3 class="card-title">Evolution du courrier arrivé</h3>
                </div>
                <div id="chart-courrier"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <img src="{{ asset('img/Mail-bro.svg') }}" class="" height="300" alt="image">
    </div>
    <div class="col-md-12">
        <x-table>
            <x-slot name="header">
                <div class="card-header">
                    <h3 class="card-title">Liste des taches</h3>
                </div>
                <div class="card-body">
                </div>
            </x-slot>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>reference</th>
                    <th>Type de tache</th>
                    <th>nom de la tache</th>
                    <th>Debut de la tache</th>
                    <th>Fin de la tache</th>
                    <th>Etat de la tache</th>
                    <th>Date de creation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>
                        <x-custom-avatar :row="$row->createur" />
                    </td>
                    <td>{{ $row->numero }}</td>
                    <td>{{ $row->type }}</td>
                    <td>
                        {{ $row->nom }}
                    </td>
                    <td>{{ $row->debut_format }}</td>
                    <td>{{ $row->fin_format }}</td>
                    <td>
                        <x-statut-task :task="$row" />
                    </td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                        <x-button-show :row="$row" href="{{ route('task.show', ['task' => $row]) }}" />
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
    </div>
</div>
@endsection
@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-courrier'), {
      		chart: {
      			type: "area",
      			fontFamily: 'inherit',
      			height: 240,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: false
      			},
      		},
      		dataLabels: {
      			enabled: false,
      		},
      		fill: {
      			opacity: .16,
      			type: 'solid'
      		},
      		stroke: {
      			width: 2,
      			lineCap: "round",
      			curve: "smooth",
      		},
      		series: [{
      			name: "Courrier arrivé",
      			data: @json($arriver->values())
      		}],
      		tooltip: {
      			theme: 'dark'
      		},
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: -4,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0,
      			},
      			tooltip: {
      				enabled: false
      			},
      			axisBorder: {
      				show: false,
      			},
      			type: 'datetime',
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		labels: @json($arriver->keys()),
      		colors: [tabler.getColor("primary")],
      		legend: {
      			show: false,
      		},
      	})).render();
      });
</script>
@endsection