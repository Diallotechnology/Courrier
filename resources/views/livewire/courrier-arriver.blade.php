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
                                        Total courrier arrivé
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
                                        Total Courrier Traité
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
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-share" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
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
                                        Total Courrier Imputé
                                    </div>
                                    <div class="text-muted">
                                        {{ $impute }}
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
                                            class="icon icon-tabler icon-tabler-file-check" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M9 15l2 2l4 -4"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total courrier Archivé
                                    </div>
                                    <div class="text-muted">
                                        {{ $archive }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-table :rows="$rows">
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title">
                    <br> NB: La suppression d'un courrier entrainera la suppression de ses imputations
                </h3>
            </div>
            <div class="card-body">
                <x-filter url="arriver" :create="App\Models\Courrier::class">
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Nature de courrier" wire:model.live='nature'>
                                @foreach ($type as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>

                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Correspondant" wire:model.live='expediteur'>
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Priorite" wire:model.live='priority'>
                                <option value="Urgent">Urgent</option>
                                <option value="Normal">Normal</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Confidentialité" wire:model.live='privacy'>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Etat" wire:model.live='etat'>
                                @foreach (App\Enum\CourrierEnum::cases() as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <x-input type="date" label="Date d'arriver" wire:model.live='date' />
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
                </x-filter>
            </div>
        </x-slot>
        <thead>
            <tr>
                <th>ID</th>
                <th>Structure</th>
                <th>Utilisateur</th>
                <th>Nature</th>
                <th>Correspondant</th>
                <th>Reference</th>
                <th>Numero/Date arriver</th>
                <th>Priorite</th>
                <th>Confidential</th>
                <th>Etat</th>
                <th>Objet</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
            <tr wire:key="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->structure_view() }}</td>
                <td>
                    <x-user-avatar :row="$row" />
                </td>
                <td>{{ $row->nature_view() }}</td>
                <td>{{ $row->correspondant_view() }}</td>
                <td>{{ $row->reference }}</td>
                <td>
                    <div class="d-flex py-1 align-items-center">
                        <div class="flex-fill">
                            <div class="font-weight-medium">N° {{ $row->numero }}</div>
                            <div class="text-muted">Date {{ $row->date_format }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <x-statut type="prio" :courrier="$row" />
                </td>
                <td>
                    <x-statut type="privacy" :courrier="$row" />
                </td>
                <td>
                    <x-statut type="etat" :courrier="$row" />
                </td>
                <td>
                    <p class="text-muted">{{ $row->objet }}</p>
                </td>
                <td>{{ $row->created_at }}</td>
                <td>
                    @if ($row->folder)
                    <x-button-folder href="{{ route('folder.show', ['folder' => $row->folder]) }}" />
                    @endif
                    <x-button-edit :row="$row" href="{{ route('arriver.edit', ['arriver' => $row]) }}" />
                    <x-button-show :row="$row" href="{{ route('arriver.show', ['arriver' => $row]) }}" />
                    <x-button-delete :row="$row" url="{{ url('courrier/arriver/'.$row->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10">
                    <h2 class="text-center">Aucun element</h2>
                </td>
            </tr>
            @endforelse
        </tbody>

    </x-table>

    <x-modal title="nouveaux courrier arriver" size="modal-lg">
        <div wire:ignore>
            <x-form route="{{ route('arriver.store') }}" enctype="multipart/form-data">
                <div class="col-md-4">
                    <x-input type="text" name="reference" place="la reference du courrier"
                        label="reference du courrier" />
                </div>
                <div class="col-md-4">
                    <x-input type="date" name="date" label="Date d'arriver" />
                </div>
                <div class="col-md-4">
                    <x-select name="nature_id" label="Nature du courrier">
                        @foreach ($type as $row)
                        <option @selected(old('nature_id')==$row->id) value="{{ $row->id }}">{{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-select name="correspondant_id" label="Correspondant(Expediteur)">
                        @foreach ($correspondant as $row)
                        <option @selected(old('correspondant_id')==$row->id) value="{{ $row->id }}">{{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-select name="priorite" label="Priorité">
                        <option @selected(old('priorite')=="Normal" ) value="Normal">Normal</option>
                        <option @selected(old('priorite')=="Urgent" ) value="Urgent">Urgent</option>
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select name="confidentiel" label="confidentiel">
                        <option @selected(old('confidentiel')==="OUI" ) value="OUI">OUI</option>
                        <option @selected(old('confidentiel')==="NON" ) value="NON">NON</option>
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF,DOC,IMAGE) facultatif"
                        :required='false' />
                </div>
                <x-textarea place="objet du courrier" name="objet" label="Objet/Origine du courrier" />
                <x-textarea place="observation ou commentaire sur le courrier" name="observation" :required='false'
                    label="observation ou commentaire Facultatif" />
            </x-form>
        </div>
    </x-modal>
</div>