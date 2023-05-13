@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Informations du courrier arriver N° {{ $arriver->numero }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Reference</div>
                <div class="datagrid-content">{{ $arriver->reference }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Numero d'arriver</div>
                <div class="datagrid-content">{{ $arriver->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date d'arriver</div>
                <div class="datagrid-content">{{ $arriver->date }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Correspondant du courrier</div>
                <div class="datagrid-content">{{ $arriver->correspondant->prenom }} {{ $arriver->correspondant->nom }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Nature du courrier</div>
                <div class="datagrid-content">{{ $arriver->nature->nom }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Priorite</div>
                <div class="datagrid-content">
                    <x-statut type="prio" :courrier="$arriver" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Confidentiel</div>
                <div class="datagrid-content">
                    <x-statut type="privacy" :courrier="$arriver" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Etat du courrier</div>
                <div class="datagrid-content">
                    <x-statut type="etat" :courrier="$arriver" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $arriver->created_at }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Objet</div>
                <div class="datagrid-content">{{ $arriver->objet }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Observation et Commentaire</div>
                <div class="datagrid-content">{{ $arriver->observation }} {{ $arriver->etat }}</div>
            </div>

        </div>
    </div>
</div>
<x-courrier-step :courrier="$arriver" />
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Fiche d'imputation courrier arriver N° {{ $arriver->numero }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Reference</div>
                <div class="datagrid-content">{{ $arriver->reference }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Departement</div>
                <div class="datagrid-content">{{ $arriver->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Instructions et Annotations</div>
                <div class="datagrid-content">{{ $arriver->numero }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Delai de traitement</div>
                <div class="datagrid-content">{{ $arriver->date }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Fin de traitement</div>
                <div class="datagrid-content">{{ $arriver->correspondant->prenom }} {{ $arriver->correspondant->nom }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Etat de l'imputation</div>
                <div class="datagrid-content">
                    <x-statut type="etat" :courrier="$arriver" />
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Date de creation</div>
                <div class="datagrid-content">{{ $arriver->created_at }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Observation et Commentaire</div>
                <div class="datagrid-content">{{ $arriver->observation }} {{ $arriver->etat }}</div>
            </div>

        </div>
    </div>
</div>
<x-table>
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des taches
            </h3>
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Type</th>
            <th>Description</th>
            <th>Debut de la tache</th>
            <th>Fin de la tache</th>
            <th>Etat</th>
            <th>Date de creation</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($arriver->tasks() as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url(./static/avatars/006m.jpg)"></span>
                    <div class="flex-fill">
                        {{-- <div class="font-weight-medium">{{ $row->name }}</div> --}}
                        {{-- <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}</a></div> --}}
                        {{-- <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true])></span> {{ $row->etat == true ? 'En ligne' : 'Pas ligne' }} --}}
                    </div>
                </div>
            </td>
            <td>{{ $row->type }}</td>
            <td>
                <p class="text-muted">{{ $row->description }}</p>

            </td>
            <td>{{ $row->debut_format }}</td>
            <td>{{ $row->fin_format }}</td>
            <td>
                <x-statut-task :task="$row" />
            </td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <h2 class="text-center">Aucune tache</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>

<x-table>
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des intervenants
            </h3>
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Type</th>
            <th>Description</th>
            <th>Debut de la tache</th>
            <th>Fin de la tache</th>
            <th>Etat</th>
            <th>Date de creation</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($arriver->tasks() as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2" style="background-image: url(./static/avatars/006m.jpg)"></span>
                    <div class="flex-fill">
                        {{-- <div class="font-weight-medium">{{ $row->name }}</div> --}}
                        {{-- <div class="text-muted"><a href="#" class="text-reset">{{ $row->email }}</a></div> --}}
                        {{-- <span @class(['badge me-1', 'bg-danger'=> $row->etat == false, 'bg-success'=> $row->etat ==
                            true])></span> {{ $row->etat == true ? 'En ligne' : 'Pas ligne' }} --}}
                    </div>
                </div>
            </td>
            <td>{{ $row->type }}</td>
            <td>
                <p class="text-muted">{{ $row->description }}</p>

            </td>
            <td>{{ $row->debut_format }}</td>
            <td>{{ $row->fin_format }}</td>
            <td>
                <x-statut-task :task="$row" />
            </td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <h2 class="text-center">Aucune tache</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>
@endsection