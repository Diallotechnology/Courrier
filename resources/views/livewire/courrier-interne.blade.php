<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">
                <br> NB: La suppression d'une structure entrainera la suppression de ses departements et utlisateurs
            </h3>

        </div>
        <div class="card-body">
            <x-filter url="interne" :create="false">
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
                            <option value="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3 col-sm-4 col-md-2">
                    <x-input type="date" label="Date d'arriver" wire:model='date' :required='false' />
                </div>

                <x-slot name="btn">
                    <a href="{{ route('interne.create') }}" class="btn btn-primary mx-2" role="button">
                        <i class="ti ti-plus"></i>
                        Nouveau
                    </a>
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
            <th>Reference</th>
            <th>Nature</th>
            <th>Expéditeur</th>
            <th>Destinateur</th>
            <th>Priorite</th>
            <th>Confidential</th>
            <th>Etat</th>
            <th>Delai de traitement</th>
            <th>Date d'envoi</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->reference }}</td>
            <td>{{ $row->nature ? $row->nature->nom : 'inexistant' }}</td>
            <td>
                @if($row->expediteur)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->expediteur->name }}')"></span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->expediteur->name }}</div>
                        <div class="text-muted">
                            <p class="text-reset">{{ $row->expediteur->email }}</p>
                        </div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>
            <td>
                @if($row->destinataire)
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2"
                        style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->destinataire->name }}')"></span>

                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $row->destinataire->name }}</div>
                        <div class="text-muted">
                            <p class="text-reset">{{ $row->destinataire->email }}</p>
                        </div>
                    </div>
                </div>
                @else
                inexistant
                @endif
            </td>
            <td>
                <x-statut type="prio" :courrier="$row" />
            </td>
            <td>
                <x-statut type="privacy" :courrier="$row" />
            </td>

            <td>
                <span @class(['status', 'status-success'=> $row->Send(), 'status-red' => $row->Recu(), 'status-indigo'
                    => $row->Read()])>
                    <span class="status-dot status-dot-animated"></span>
                    {{ $row->etat }}
                </span>
            </td>
            <td>
                {{ $row->delai_format }}
            </td>
            <td>{{ $row->created_at }}</td>
            <td>
                @if($row->Recu() || $row->Read())
                <a aria-label="Button" class="btn btn-primary btn-icon">
                    <i class="ti ti-mail-forward"></i>
                </a>
                @endif
                <x-button-edit href="{{ route('interne.edit', ['interne' => $row]) }}" />
                <x-button-show href="{{ route('interne.show', ['interne' => $row]) }}" />
                <x-button-delete url="{{ url('courrier/interne/'.$row->id) }}" />
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