<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter url="interne" :create="false">
                <div class="mb-3  col-md-3">
                    <div wire:ignore>
                        <x-select label="Nature de courrier" :required='false' wire:model.live='nature'>
                            @foreach ($type as $row)
                            <option value="{{ $row->id }}">{{ $row->nom }}</option>
                            @endforeach
                        </x-select>

                    </div>
                </div>
                <div class="mb-3  col-md-3">
                    <div wire:ignore>
                        <x-select label="Priorite" :required='false' wire:model.live='priority'>
                            <option value="Urgent">Urgent</option>
                            <option value="Normal">Normal</option>
                        </x-select>
                    </div>
                </div>
                <div class="mb-3  col-md-3">
                    <div wire:ignore>
                        <x-select label="Confidentialité" :required='false' wire:model.live='privacy'>
                            <option value="OUI">OUI</option>
                            <option value="NON">NON</option>
                        </x-select>
                    </div>
                </div>
                <div class="mb-3  col-md-3">
                    <div wire:ignore>
                        <x-select label="Etat" :required='false' wire:model.live='etat'>
                            @foreach (App\Enum\CourrierInterneEnum::cases() as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3  col-md-3">
                    <x-input type="date" label="Date d'envoi" wire:model.live='date' :required='false' />
                </div>

                <x-slot name="btn">
                    @can('create',App\Models\Interne::class)
                    <a href="{{ route('interne.create') }}" class="btn btn-primary mx-2" role="button">
                        <i class="ti ti-plus"></i>
                        Nouveau
                    </a>
                    @endcan
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
            <td>{{ $row->numero }}</td>
            <td>{{ $row->nature_view() }}</td>
            <td>
                <x-custom-avatar :row="$row->expediteur" />
            </td>
            <td>
                <x-custom-avatar :row="$row->destinataire" />
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
                @can('create',$row)
                @if($row->Recu() || $row->Read())
                <a aria-label="Button" href="{{ route('interne.show', ['interne' => $row]) }}"
                    class="btn btn-primary btn-icon">
                    <i class="ti ti-mail-forward"></i>
                </a>
                @endif
                @endcan
                @if ($row->folder)
                <x-button-folder href="{{ route('folder.show', ['folder' => $row->folder]) }}" />
                @endif
                <x-button-edit :row="$row" href="{{ route('interne.edit', ['interne' => $row]) }}" />
                <x-button-show :row="$row" href="{{ route('interne.show', ['interne' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('courrier/interne/'.$row->id) }}" />
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