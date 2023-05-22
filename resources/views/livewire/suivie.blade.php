<div>
    <x-table :rows="$rows">
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title">Lites des courriers arriver
                </h3>

            </div>
            <div class="card-body">
                <x-filter url="arriver" :create="false">
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Nature de courrier" :required='false' wire:model='nature'>
                                @foreach ($type as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Correspondant" :required='false' wire:model='expediteur'>
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}">{{ $row->prenom }} {{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Priorite" :required='false' wire:model='priority'>
                                <option value="Urgent">Urgent</option>
                                <option value="Normal">Normal</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Confidentialité" :required='false' wire:model='privacy'>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Etat" :required='false' wire:model='etat'>
                                @foreach (App\Enum\CourrierEnum::cases() as $row)
                                @continue($loop->first)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <x-input type="date" label="Date d'arriver" wire:model='date' :required='false' />
                    </div>
                    <x-slot name="btn">
                    </x-slot>
                </x-filter>
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
                    <x-button-show href="{{ route('arriver.show', ['arriver' => $row]) }}" />
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

</div>