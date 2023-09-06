<div>
    <x-table :rows="$rows">
        <x-slot name="header">
            <div class="card-body">
                <x-filter url="arriver">
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Nature de courrier" wire:model='nature'>
                                @foreach ($type as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>

                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Correspondant" wire:model='expediteur'>
                                @foreach ($correspondant as $row)
                                <option value="{{ $row->id }}">{{ $row->nom }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Priorite" wire:model='priority'>
                                <option value="Urgent">Urgent</option>
                                <option value="Normal">Normal</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <div wire:ignore>
                            <x-select label="Confidentialité" wire:model='privacy'>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <x-input type="date" label="Date d'archivage" wire:model='archive' />
                    </div>
                    <div class="mb-3 col-sm-4 col-md-2">
                        <x-input type="date" label="Date d'arriver" wire:model='date' />
                    </div>
                    <x-slot name="btn"></x-slot>
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
                <th>Archivé le</th>
                <th>Date de création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
            <tr>
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
                <td>{{ $row->archived_at }}</td>
                <td>{{ $row->created_at }}</td>
                <td>
                    <x-button-show :row="$row" href="{{ route('arriver.show', ['arriver' => $row]) }}" />
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
    @push('scripts')
    <script>
        $(document).on('livewire:init', function() {
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