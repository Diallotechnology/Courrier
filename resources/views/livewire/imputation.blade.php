<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'une imputation entrainera la suppression de tous les elements lié
            </h3>

        </div>
        <div class="card-body">
            <x-filter url="imputation">
                <div class="mb-3 col-sm-4 col-md-4">
                    <div wire:ignore>
                        <x-select label="Courrier arrivé" :required='false' wire:model='courrier'>
                            @foreach ($arriver as $row)
                            <option value="{{ $row->id }}">{{ $row->reference }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3 col-sm-4 col-md-4">
                    <div wire:ignore>
                        <x-select label="Departement" :required='false' wire:model='departement'>
                            @foreach ($division as $row)
                            <option value="{{ $row->id }}">{{ $row->prenom }} {{ $row->nom }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3 col-sm-4 col-md-4">
                    <div wire:ignore>
                        <x-select label="Priorite" :required='false' wire:model='priority'>
                            <option value="Urgent">Urgent</option>
                            <option value="Normal">Normal</option>
                        </x-select>
                    </div>
                </div>
                <div class="mb-3 col-sm-4 col-md-4">
                    <div wire:ignore>
                        <x-select label="Etat" :required='false' wire:model='etat'>
                            @foreach (App\Enum\ImputationEnum::cases() as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3 col-sm-4 col-md-4">
                    <x-input type="date" label="Delai de traitement" wire:model='delai' :required='false' />
                </div>
                <div class="mb-3 col-sm-4 col-md-4">
                    <x-input type="date" label="Date de fin traitement" wire:model='fin' :required='false' />
                </div>

                <x-slot name="btn">
                    <button class="btn btn-info mx-2" type="button">
                        <i class="ti ti-file-export"></i>
                        Export
                    </button>
                </x-slot>
            </x-filter>
        </div>
    </x-slot>
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
        @forelse ($rows as $row)
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
                <x-button-edit href="{{ route('imputation.edit', ['imputation' => $row]) }}" />
                <x-button-show href="{{ route('imputation.show', ['imputation' => $row]) }}" />
                <x-button-delete url="{{ url('imputation/'.$row->id) }}" />
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
                <x-select label="Courrier arrivé" name="courrier_id">
                    @foreach ($arriver as $row)
                    <option value="{{ $row->id }}">Reférence {{ $row->reference }}, Numero d'arriver {{ $row->numero
                        }},Date
                        d'arriver {{
                        $row->date_format }}
                    </option>
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select label="Departement" name="departement_id[]" multiple>
                    @foreach ($division as $row)
                    <option value="{{ $row->id }}"> {{ $row->nom }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="col-md-6">
                <x-input type="date" label="Delai" name='delai' :required='false' />
            </div>
            <div class="col-md-6">
                <x-select name="priorite" label="Priorité">
                    <option value="Normal">Normal</option>
                    <option value="Urgent">Urgent</option>
                </x-select>
            </div>
            <div class="col-md-6">
                <x-select name="notif" label="Notification par email">
                    <option value="1">OUI</option>
                    <option value="0">NON</option>
                </x-select>
            </div>

            <h2 class="text-center">Annotations et instructions</h2>
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
    $(document).on('livewire:load', function() {
            $('.select-tags').each(function() {
                var select = new TomSelect(this, {
                    onChange: function(value) {
                        var modelName = $(this.input).attr('wire:model');
                        @this.set(modelName, value);
                    }
                });
            });
        });
</script>
@endpush