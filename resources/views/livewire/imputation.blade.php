<div>
    <div class="row row-deck row-cards mb-3">
        <div class="col-12">
            <div class="row row-cards">
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
                                        Total Imputations
                                    </div>
                                    <div class="text-muted">
                                        {{ $rows->total() }}
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
                                            class="icon icon-tabler icon-tabler-checks" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 12l5 5l10 -10"></path>
                                            <path d="M2 12l5 5m5 -5l5 -5"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total Imputation Traitée
                                    </div>
                                    <div class="text-muted">
                                        {{ $termine }}
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                            <path d="M5.7 5.7l12.6 12.6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total Imputation Expire
                                    </div>
                                    <div class="text-muted">
                                        {{ $expire }}
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
                                            class="icon icon-tabler icon-tabler-loader" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 6l0 -3"></path>
                                            <path d="M16.25 7.75l2.15 -2.15"></path>
                                            <path d="M18 12l3 0"></path>
                                            <path d="M16.25 16.25l2.15 2.15"></path>
                                            <path d="M12 18l0 3"></path>
                                            <path d="M7.75 16.25l-2.15 2.15"></path>
                                            <path d="M6 12l-3 0"></path>
                                            <path d="M7.75 7.75l-2.15 -2.15"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total Imputation en cours
                                    </div>
                                    <div class="text-muted">
                                        {{ $process }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-table :rows="$rows" url="imputation" :create="App\Models\Imputation::class">
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title">
                    <br> NB: La suppression d'une imputation entrainera la suppression de tous les elements lié
                </h3>
            </div>
        </x-slot>
        <x-slot name="filter">
            <div class="col-sm-4 col-md-3">
                <div wire:ignore>
                    <x-select label="Courrier arrivé" wire:model.live='courrier'>
                        @foreach ($arriver as $row)
                        <option value="{{ $row->id }}">N/A {{ $row->reference }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Priorite" wire:model.live='priority'>
                        <option value="Urgent">Urgent</option>
                        <option value="Normal">Normal</option>
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Etat" wire:model.live='etat'>
                        @foreach (App\Enum\ImputationEnum::cases() as $row)
                        <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <x-input type="date" label="Delai de traitement" wire:model.live='delai' />
            </div>
            <div class="col-sm-4 col-md-2">
                <x-input type="date" label="Date de fin traitement" wire:model.live='fin' />
            </div>
            <x-slot name="btn">
                <button type="button" class="btn btn-indigo dropdown-toggle" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-database-export"></i>
                    Exporté
                </button>
                <div class="dropdown-menu" style="">
                    <button wire:click='export' class="dropdown-item">Excel</button>
                </div>
            </x-slot>
        </x-slot>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Reference</th>
                <th>N/A du courrier</th>
                <th>Departement concerné</th>
                <th>Sous Departement</th>
                <th>Priorité</th>
                <th>Etat</th>
                <th>Delai</th>
                <th>Fin de traitement</th>
                <th>Date de creation</th>
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
                <td>{{ $row->numero }}</td>
                <td>{{ $row->courrier ? $row->courrier->numero : 'inexistant' }}</td>
                <td>
                    @forelse ($row->departements as $item)
                    <div wire:key="{{ $item->id }}">{{ $item->nom }}</div>
                    @empty
                    aucun
                    @endforelse
                </td>
                <td>
                    @forelse ($row->subdepartements as $item)
                    <div wire:key="{{ $item->id }}">{{ $item->nom }}</div>
                    @empty
                    aucun
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
                    <x-button-edit :row="$row" href="{{ route('imputation.edit', ['imputation' => $row]) }}" />
                    <x-button-show :row="$row" href="{{ route('imputation.show', ['imputation' => $row]) }}" />
                    <x-button-delete :row="$row" url="{{ url('imputation/'.$row->id) }}" />
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
    <x-modal title="nouvelle imputation" size="modal-lg">
        <div wire:ignore>
            <x-form route="{{ route('imputation.store') }}">
                <div class="col-md-12">
                    <x-select label="liste des Courriers arrivés" name="courrier_id">
                        @foreach ($arriver as $row)
                        <option @selected(old('courrier_id')==$row->id) value="{{ $row->id }}">
                            Reférence {{ $row->reference }}, Numero d'arriver {{ $row->numero }},
                            Date d'arriver {{ $row->date_format }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select label="Departement concernés" :required='false' name="departement_id[]" multiple>
                        <optgroup label="Departement">
                            @foreach ($division as $row)
                            <option value="{{ $row->id }}">{{ $row->nom }}</option>
                            @endforeach
                        </optgroup>
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select label="Sous Departement concernés" :required='false' name="subdepartement_id[]" multiple>
                        <optgroup label="Sous Departement">
                            @foreach ($sub_division as $item)
                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                            @endforeach
                        </optgroup>
                    </x-select>
                </div>

                <div class="col-md-5">
                    <x-input type="date" label="Delai de traitement facultatif" name='delai' :required='false' />
                </div>
                <div class="col-md-3">
                    <x-select name="priorite" label="Priorité">
                        <option @selected(old('priorite')=="Normal" ) value="Normal">Normal</option>
                        <option @selected(old('priorite')=="Urgent" ) value="Urgent">Urgent</option>
                    </x-select>
                </div>
                <div class="col-md-4">
                    <x-select name="notif" label="Notification par email">
                        <option value="1">OUI</option>
                        <option value="0">NON</option>
                    </x-select>
                </div>

                <h2 class="text-center">Annotations ou instruction de traitement</h2>
                <div class="divide-y">
                    <div class="mb-3">
                        <div class="row">
                            @forelse (Auth::user()->annotations as $row)
                            <div class="col-md-4">
                                <label class="form-check">
                                    <input class="form-check-input" value="{{ $row->id }}" name="annotation_id[]"
                                        type="checkbox">
                                    <span class="form-check-label">{{ $row->nom }}</span>
                                </label>
                            </div>
                            @empty
                            <label class="form-label text-center">Aucune annotation</label>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <x-textarea place="observation ou commentaire sur l'imputation" name="observation" :required='false'
                        label="observation ou commentaire Facultatif" />
                </div>
            </x-form>
        </div>
    </x-modal>
</div>