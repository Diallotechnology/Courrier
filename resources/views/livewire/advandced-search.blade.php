<div>
    @section('header')
    <div class="col">
        <div class="mb-1">
            <ol class="breadcrumb" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Filtre avancé</a></li>
            </ol>
        </div>
        <h2 class="page-title">
            <span class="text-truncate">Filtre avancée</span>
        </h2>
    </div>
    @endsection
    @section('content')
    <div class="card">
        <div class="card-body">
            <div wire:loading.class="opacity-50">
                <div class="row row-cards">
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Type de courrier" wire:model.live="model">
                                <option value="Arrive">Courrier Arrivé</option>
                                <option value="Depart">Courrier Depart</option>
                            </x-select>
                        </div>
                    </div>
                    <div @class(['mb-3 col-md-4', 'd-none'=> $model === "Depart"]) >
                        <x-input type="text" label="Reference du courrier" place="Reference du courrier"
                            wire:model.live="reference" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <x-input type="text" label="numero arriver/depart" place="numero arriver ou depart"
                            wire:model.live="numero" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Nature du courrier" wire:model.live="nature">
                                @foreach ($type as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Correspondant" wire:model.live="expediteur">
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Confidentialité" wire:model.live="privacy">
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <x-input type="date" label="Date d'arriver/départ" wire:model.live="date" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Priorite" wire:model.live="priority">
                                <option value="Urgent">Urgent</option>
                                <option value="Normal">Normal</option>
                            </x-select>
                        </div>
                    </div>
                    <div @class(['mb-3 col-md-4', 'd-none'=> $model === "Depart"])>
                        <div wire:ignore>
                            <x-select label="Etat" wire:model.live="etat">
                                @foreach (App\Enum\CourrierEnum::cases() as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div @class(['mb-3 col-md-4', 'd-none'=> $model === "Depart"])>
                        <x-input type="date" label="Date de fin traitement" wire:model.live="fin" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <x-input type="date" label="Date d'enregistrement" wire:model.live="create" />
                    </div>
                    <div>
                        <button wire:click='ResetFilter' class="btn btn-danger mx-2" type="button">
                            <i class="ti ti-file-export"></i>
                            Reset Filtres
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <x-table :rows="$rows" :create="false">
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title">
                    @if ($rows->isNotEmpty())
                    {{ $rows->total() }} resultats trouvés
                    @endif
                </h3>
            </div>
        </x-slot>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Structure</th>
                <th>Nature</th>
                <th>Correspondant</th>
                <th>Reference</th>
                <th>Priorite</th>
                <th>Confidential</th>
                <th>Numero/Date arriver</th>
                <th>Etat</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
            <tr wire:key="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>
                    <x-user-avatar :row="$row" />
                </td>
                <td>{{ $row->structure_view() }}</td>
                <td>{{ $row->nature_view() }}</td>
                <td>
                    @if ($model === "Arrive")
                    {{ $row->correspondant_view() }}
                    @endif
                    @if ($model === "Depart")
                    @forelse ($row->correspondants as $item)
                    <div wire:key="{{ $item->id }}"> {{ $item->nom }}</div>
                    @empty
                    aucun
                    @endforelse
                    @endif
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
                    @if($model === "Arrive")
                    <x-statut type="etat" :courrier="$row" />
                    @endif
                </td>
                <td>{{ $row->created_at }}</td>
                <td>
                    @if($model === "Arrive")
                    <x-button-show :row="$row" href="{{ route('arriver.show', ['arriver' => $row]) }}" />
                    @elseif ($model === "Depart")
                    <x-button-show :row="$row" href="{{ route('depart.show', ['depart' => $row]) }}" />
                    @endif
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
    @endsection
</div>