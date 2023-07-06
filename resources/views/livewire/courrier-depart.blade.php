<x-table :rows="$rows">
    <x-slot name="header">
        <div class="card-body">
            <x-filter url="depart" :create="App\Models\Depart::class">
                <div class="mb-3 col-sm-4 col-md-3">
                    <div wire:ignore>
                        <x-select label="Nature de courrier" :required='false' wire:model='nature'>
                            @foreach ($type as $row)
                            <option value="{{ $row->id }}">{{ $row->nom }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mb-3 col-sm-4 col-md-3">
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
                    <x-input type="date" label="Date depart" wire:model='date' :required='false' />
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
            <th>Structure</th>
            <th>Numero depart</th>
            <th>Date depart</th>
            <th>Nature</th>
            <th>Correspondant</th>
            <th>En Reponse</th>
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
        <tr>
            <td>{{ $row->id }}</td>
            <td>
                <x-user-avatar :row="$row" />
            </td>
            <td>{{ $row->structure ? $row->structure->nom : 'inexistant' }}</td>
            <td>{{ $row->numero }}</td>
            <td>
                {{ $row->date_format }}
            </td>
            <td>{{ $row->nature ? $row->nature->nom : 'inexistant' }}</td>
            <td>
                @forelse ($row->correspondants as $item)
                <div> {{ $item->nom }}</div>
                @empty
                aucun
                @endforelse
            </td>
            <td>{{ $row->courrier ? 'Courrier N°'. $row->courrier->numero : 'pas de response' }}</td>

            <td>
                <x-statut type="prio" :courrier="$row" />
            </td>
            <td>
                <x-statut type="privacy" :courrier="$row" />
            </td>
            <td>
                <span @class(['status status-success'])>{{ $row->etat }}</span>
            </td>
            <td>
                <p class="text-muted">{{ $row->objet }}</p>
            </td>
            <td>{{ $row->created_at }}</td>
            <td>
                <x-button-edit :row="$row" href="{{ route('depart.edit', ['depart' => $row]) }}" />
                <x-button-show :row="$row" href="{{ route('depart.show', ['depart' => $row]) }}" />
                <x-button-delete :row="$row" url="{{ url('courrier/depart/'.$row->id) }}" />
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
<x-modal title="nouveaux courrier depart" size="modal-lg">
    <div wire:ignore>
        <x-form route="{{ route('depart.store') }}" enctype="multipart/form-data">
            <div class="col-md-6">
                <x-select name="nature_id" label="Nature de courrier">
                    @foreach ($type as $row)
                    <option value="{{ $row->id }}">{{ $row->nom }}
                    </option>
                    @endforeach
                </x-select>
            </div>

            <div class="col-md-6">
                <x-select name="correspondant_id[]" multiple label="Correspondant (Destinateurs)">
                    @foreach ($correspondant as $row)
                    <option value="{{ $row->id }}">{{ $row->nom }}</option>
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
                <x-input type="date" name="date" label="Date de depart" />
            </div>
            <div class="col-md-6">
                <x-input type="file" multiple name="files[]" label="Pièces jointe (PDF,DOC,IMAGE) facultatif"
                    :required='false' />
            </div>
            <div class="col-md-12">
                <x-select name="courrier_id" :required='false'
                    label="Ce courrier depart est la reponse d'un courrier arriver? facultatif">
                    @foreach ($courrier as $row)
                    <option value="{{ $row->id }}">Reference {{ $row->reference }}, N° {{ $row->numero }}, Date
                        d'arriver {{
                        $row->date_format }}
                    </option>
                    @endforeach
                </x-select>
            </div>
            <x-input place="objet du courrier" name="objet" label="Objet/Origine du courrier" />
            <x-textarea place="observation ou commentaire sur le courrier" name="observation" :required='false'
                label="observation ou commentaire Facultatif" />
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