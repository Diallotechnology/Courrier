<div>
    <div class="card">
        <div class="card-body">
            <h1 class="text-center my-3">Filtre avancée</h1>
            <div wire:loading.class="opacity-50">
                <div class="row row-cards">
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Type de courrier" :required="false" wire:model="model">
                                <option value="Arrive">Courrier Arrivé</option>
                                <option value="Depart">Courrier Depart</option>
                                <option value="Imputation">Imputation</option>
                                <option value="Rapport">Rapport</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <x-input type="text" label="Reference" wire:model="reference" :required="false" />
                    </div>
                    @if($model === "Arrive" || $model === "Depart")
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Nature de courrier" :required="false" wire:model="nature">
                                @foreach ($type as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Correspondant" :required="false" wire:model="expediteur">
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}">{{ $row->prenom }} {{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <div wire:DOMContentLoaded="initializeSelectTags">
                            <x-select label="Confidentialité" :required="false" wire:model="privacy">
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <x-input type="date" label="Date d'arriver" wire:model="date" :required="false" />
                    </div>
                    @endif
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Priorite" :required="false" wire:model="priority">
                                <option value="Urgent">Urgent</option>
                                <option value="Normal">Normal</option>
                            </x-select>
                        </div>
                    </div>
                    @isset($statut)
                    <div class="mb-3 col-md-4">
                        <div wire:ignore>
                            <x-select label="Etat" :required="false" wire:model="etat">
                                @foreach ($statut as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    @endisset

                    @if($show)
                    <div class="mb-3 col-md-4 col-md-4">
                        <div wire:ignore>
                            <x-select label="Courrier arrivé" :required="false" wire:model="courrier">
                                @foreach ($courrier as $row)
                                <option value="{{ $row->id }}">{{ $row->reference }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="mb-3 col-md-4 col-md-4">
                        <div wire:ignore>
                            <x-select label="Departement" :required="false" wire:model="departement">
                                @foreach ($division as $row)
                                <option value="{{ $row->id }}">{{ $row->prenom }} {{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-4 col-md-4">
                        <x-input type="date" label="Delai de traitement" wire:model="delai" :required="false" />
                    </div>
                    <div class="mb-3 col-md-4 col-md-4">
                        <x-input type="date" label="Date de fin traitement" wire:model="fin" :required="false" />
                    </div>
                    @endif
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Date de creation</label>
                        <div class="input-icon mb-2">
                            <input class="form-control" type="text" placeholder="Select a date"
                                wire:model="selectedDate" id="datepicker" />
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                    <path d="M16 3l0 4" />
                                    <path d="M8 3l0 4" />
                                    <path d="M4 11l16 0" />
                                    <path d="M11 15l1 0" />
                                    <path d="M12 15l0 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-table :rows="$rows">
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title"> {{ count($rows) }} resultat trouvés
                </h3>
            </div>
            <div class="card-body">
                <x-filter :create="false" />

            </div>
        </x-slot>
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
            @forelse ($rows as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>
                    <x-user-avatar :row="$row" />
                </td>
                <td>{{ $row->nature ? $row->nature->nom : 'inexistant' }}</td>
                <td>
                    {{ $row->correspondant ? $row->correspondant->prenom.' '.$row->correspondant->nom : 'inexistant' }}
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
                    <x-button-edit href="{{ route('arriver.edit', ['arriver' => $row]) }}" />
                    <x-button-show href="{{ route('arriver.show', ['arriver' => $row]) }}" />
                    <x-button-delete url="{{ url('courrier/arriver/'.$row->id) }}" />
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
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
    window.Litepicker && new Litepicker({
        element: document.getElementById("datepicker"),
        singleMode: true,
        onSelect: function(date) {
            Livewire.emit('updated:selectedDate', date.toDateString());
        },
    });
});
    </script> --}}
</div>