<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-header">
            <h3 class="card-title">Lites des courriers arriver
                <br> NB: La suppression d'une structure entrainera la suppression de ses departements et utlisateurs
            </h3>

        </div>
        <div class="card-body">
            <x-filter url="arriver">
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
                            <option value="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3 col-sm-4 col-md-2">
                    <x-input type="date" label="Date d'arriver" wire:model='date' :required='false' />
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
            {{-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                    aria-label="Select all invoices"></th> --}}
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

            {{-- <td><input class="form-check-input m-0 align-middle" id="{{ $row->id }}" wire:model="selectedRows"
                    value="{{ $row->id }}" type="checkbox" aria-label="Select item"></td> --}}
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

<x-modal title="nouveaux courrier arriver" size="modal-lg">
    <x-form route="{{ route('arriver.store') }}" enctype="multipart/form-data">
        <div class="col-md-6">
            <x-select name="nature_id" label="Nature de courrier">
                @foreach ($type as $row)
                <option value="{{ $row->id }}">{{ $row->nom }}
                </option>
                @endforeach
            </x-select>
        </div>

        <div class="col-md-6">
            <x-select name="correspondant_id" label="Correspondant(Expediteur)">
                @foreach ($correspondant as $row)
                <option value="{{ $row->id }}">{{ $row->prenom.' '.$row->nom }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="col-md-6">
            <x-select name="priorite" label="Priorité">
                <option value="Normal">Normal</option>
                <option value="Urgent">Urgent</option>
            </x-select>
        </div>
        <div class="col-md-6">
            <x-select name="confidentiel" label="confidentiel">
                <option value="OUI">OUI</option>
                <option value="NON">NON</option>
            </x-select>
        </div>
        <div class="col-md-6">
            <x-input type="date" name="date" label="Date d'arriver" />
        </div>
        <div class="col-md-6">
            <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF) facultatif" :required='false' />
        </div>
        <x-textarea place="objet du courrier" name="objet" label="Objet/Origine du courrier" />
        <x-textarea place="observation ou commentaire sur le courrier" name="observation" :required='false'
            label="observation ou commentaire Facultatif" />
    </x-form>
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
