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
                <div class="datagrid-content"> {{ $arriver->correspondant_view()}}
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Nature du courrier</div>
                <div class="datagrid-content">
                    {{ $arriver->nature_view() }}
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
                <div class="datagrid-title">Archivé ce courrier</div>
                <div class="datagrid-content">
                    <livewire:form-switch :courrier="$arriver">
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
                <h3 class="card-title">Les imputations du courrier arriver N° {{ $arriver->numero }}
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
            @forelse ($arriver->imputations as $row)
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
            <th>reference</th>
            <th>Type de tache</th>
            <th>Exécutant</th>
            <th>nom de la tache</th>
            <th>Debut de la tache</th>
            <th>Fin de la tache</th>
            <th>Etat de la tache</th>
            <th>Date de creation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($task as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                @if($row->createur)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->createur->name }}')"></span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->createur->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $row->createur->email }}</a>
                        </div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>
            <td>{{ $row->numero }}</td>
            <td>{{ $row->type }}</td>
            <td>
                @forelse ($row->users as $item)
                <div>
                    @if($item->pivot->etat == true)
                    <i class="ti ti-checks"></i>
                    @endif
                    {{ $item->email }}
                </div>
                {{-- <div class="mb-2">Departement {{ $item->userable->nom }}</div> --}}
                @empty
                @if($row->type === "imputation")
                <a role="button" href="{{ route('task.show', ['task' => $row]) }}" class="btn btn-indigo ">
                    <i class="ti ti-user"></i> assigner
                </a>
                @endif
                @endforelse
            </td>
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

                @if(!$row->Pending() && !$row->Complet() && auth()->user()->tasks->contains($row) &&
                auth()->user()->pivot_values->contains($row))
                <button type="button" wire:click="ValidTask({{ $row->id }})" class="btn btn-indigo btn-icon">
                    <i class="ti ti-checks"></i>
                </button>
                @endif
                <x-button-show :row="$row" href="{{ route('task.show', ['task' => $row]) }}" />
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
