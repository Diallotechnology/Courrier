<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'une imputation entrainera la suppression de tous les elements lié
            </h3>
        </div>
        <div class="card-body">
            <x-filter url="imputation" :create="App\Models\Imputation::class">
                <div class="mb-3  col-md-3">
                    <div wire:ignore>
                        <x-select label="Courrier arrivé" wire:model.live='courrier'>
                            @foreach ($arriver as $row)
                            <option value="{{ $row->id }}">N/A {{ $row->reference }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3  col-md-3">
                    <div wire:ignore>
                        <x-select label="Priorite" wire:model.live='priority'>
                            <option value="Urgent">Urgent</option>
                            <option value="Normal">Normal</option>
                        </x-select>
                    </div>
                </div>
                <div class="mb-3  col-md-3">
                    <div wire:ignore>
                        <x-select label="Etat" wire:model.live='etat'>
                            @foreach (App\Enum\ImputationEnum::cases() as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3  col-md-3">
                    <x-input type="date" label="Delai de traitement" wire:model.live='delai' />
                </div>
                <div class="mb-3  col-md-3">
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
            </x-filter>
        </div>
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
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->numero }}</td>
            <td>{{ $row->courrier ? $row->courrier->numero : 'inexistant' }}</td>
            <td>
                @forelse ($row->departements as $item)
                <div>{{ $item->nom }}</div>
                @empty
                aucun
                @endforelse
            </td>
            <td>
                @forelse ($row->subdepartements as $item)
                <div>{{ $item->nom }}</div>
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
@push('scripts')
<script>
    $(document).on('livewire:init', function() {
        $('.select-tags').each(function() {
            var select = new TomSelect(this, {
                onChange: function(value) {
                    var modelName = $(this.input).attr('wire:model.live');
                    @this.set(modelName, value);
                }
            });
        });
    });

</script>
@endpush