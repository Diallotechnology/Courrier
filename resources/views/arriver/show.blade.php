@extends('layouts.app')
@section('content')
<x-courrier-step :courrier="$arriver" />
<div class="row py-2">
    @foreach ($arriver->documents as $row)
    <div class="col-md-3">
        <x-card-document :row="$row" />
    </div>
    @endforeach
</div>
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
                <div class="datagrid-content">{{ $arriver->date_format }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Correspondant du courrier</div>
                <div class="datagrid-content"> {{ $arriver->correspondant ? $arriver->correspondant->nom : 'inexistant'
                    }}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Nature du courrier</div>
                <div class="datagrid-content">
                    {{ $arriver->nature ? $arriver->nature->nom : 'inexistant' }}
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
                <div class="datagrid-content">{{ $arriver->observation }}</div>
            </div>

        </div>
    </div>
</div>
<div class="card">
    <x-table>
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title">Informations de l'imputation du courrier arriver N° {{ $arriver->numero }}
                </h3>
            </div>
        </x-slot>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Reference</th>
                <th>N/A du courrier</th>
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
            @forelse ($imp as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>
                    <x-user-avatar :row="$row" />
                </td>
                <td>{{ $row->numero }}</td>
                <td>{{ $row->courrier ? $row->courrier->numero : 'inexistant' }}</td>
                <td>
                    @forelse ($row->departements as $item)
                    <div>
                        {{ $item->nom }}
                    </div>
                    @empty
                    Aucun
                    @endforelse
                </td>
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
                    <x-button-show :row="$row" href="{{ route('imputation.show', ['imputation' => $row]) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11">
                    <h2 class="text-center">Aucun element</h2>
                </td>
            </tr>
            @endforelse
        </tbody>
    </x-table>
</div>
<x-table>
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Liste des taches
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
        @forelse ($arriver->tasks as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                @if($item->createur)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $item->createur->name }}')"></span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $item->createur->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $item->createur->email }}</a></div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>
            <td>{{ $item->type }}</td>
            <td>
                <p class="text-muted">{{ $item->description }}</p>
            </td>
            <td>{{ $item->debut_format }}</td>
            <td>{{ $item->fin_format }}</td>
            <td>
                <x-statut-task :task="$item" />
            </td>
            <td>{{ $item->created_at }}</td>
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
            <h3 class="card-title">Liste des intervenants
            </h3>
        </div>
    </x-slot>
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Department</th>
            <th>Courrier arriver N°</th>
            <th>Action</th>
            <th>Description</th>
            <th>Date de creation</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($arriver->histories as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->user->userable->nom }}</td>
            <td>{{ $row->courrier->numero }}</td>
            <td>{{ $row->action }}</td>
            <td>
                <p class="text-muted">{{ $row->description }}</p>
            </td>
            <td>{{ $row->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <h2 class="text-center">Aucune element</h2>
            </td>
        </tr>
        @endforelse
    </tbody>
</x-table>
@endsection