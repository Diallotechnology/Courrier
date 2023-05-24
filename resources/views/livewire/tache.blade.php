<div>
    <x-table :rows="$rows">
        <x-slot name="header">
            <div class="card-header">
                <h3 class="card-title">Liste des taches
                    <br> NB: La suppression d'une structure entrainera la suppression de ses departements et utlisateurs
                </h3>

            </div>
            <div class="card-body">
                <x-filter url="task">
                    <div class="mb-3 col-sm-4 col-md-3">
                        <div wire:ignore>
                            <x-select label="Type de tache" :required='false' wire:model='type'>
                                <option value="utilisateur">Utilisateur</option>
                                <option value="imputation">Imputation</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="mb-3 col-sm-4 col-md-3">
                        <x-input type="date" label="Date de debut" wire:model='debut' :required='false' />
                    </div>
                    <div class="mb-3 col-sm-4 col-md-3">
                        <x-input type="date" label="Date de fin" wire:model='fin' :required='false' />
                    </div>
                    <div class="mb-3 col-sm-4 col-md-3">
                        <div wire:ignore>
                            <x-select label="Etat" :required='false' wire:model='etat'>
                                @foreach (App\Enum\TaskEnum::cases() as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </x-select>
                        </div>
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
                <th>reference</th>
                <th>Type de tache</th>
                <th>nom de la tache</th>
                <th>Debut de la tache</th>
                <th>Fin de la tache</th>
                <th>Etat de la tache</th>
                <th>Date de creation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>
                    @if($row->createur)
                    <div class="d-flex py-1 align-items-center">
                        <span class="avatar me-2"
                            style="background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $row->createur->name }}')"></span>
                        <div class="flex-fill">
                            <div class="font-weight-medium">{{ $row->createur->name }}</div>
                            <div class="text-muted"><a href="#" class="text-reset">{{ $row->createur->email }}</a></div>
                        </div>
                    </div>
                    @else
                    inexistant
                    @endif
                </td>
                <td>{{ $row->reference }}</td>
                <td>{{ $row->type }}</td>
                <td>
                    {{ $row->nom }}
                </td>
                <td>{{ $row->debut_format }}</td>
                <td>{{ $row->fin_format }}</td>
                <td>
                    <x-statut-task :task="$row" />
                </td>
                <td>{{ $row->created_at }}</td>
                <td>
                    @if(!$row->Pending() and !$row->Complet())
                    <button type="button" wire:click="ValidTask({{ $row->id }})" class="btn btn-indigo btn-icon">
                        <i class="ti ti-checks"></i>
                    </button>
                    @endif
                    <x-button-edit href="{{ route('task.edit', ['task' => $row]) }}" />
                    <x-button-show href="{{ route('task.show', ['task' => $row]) }}" />
                    <x-button-delete url="{{ url('task/'.$row->id) }}" />
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
    <x-modal title="nouvelle tache">
        <x-form route="{{ route('task.store') }}">
            <div class="col-md-6">
                <x-input type="text" name="nom" place="le nom de la tache" />
            </div>
            <div class="col-md-6">
                <div wire:ignore>
                    <x-select name="type" id="type" label="type de tache">
                        <option value="utilisateur">Utilisateur</option>
                        <option value="imputation">Imputation</option>
                    </x-select>
                </div>
            </div>
            <div class="col-md-12">
                <div wire:ignore>
                    <x-select name="user_id[]" multiple label="liste des Utilisateurs">
                        @foreach ($user as $key => $row)
                        <optgroup label="Departement {{ $key }}">
                            @foreach ($row as $item)
                            <option
                                data-custom-properties="&lt;span class=&quot;avatar avatar-xs&quot;  style=&quot;background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $item->name }}')&quot;&gt;&lt;/span&gt;"
                                value="{{ $item->id }}">{{ $item->email }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-md-6">
                <x-input type="datetime-local" name="debut" label="Debut de la tache" />
            </div>
            <div class="col-md-6">
                <x-input type="datetime-local" name="fin" label="Fin de la tache" />
            </div>
            <x-textarea place="Fait une description de la tache" name="description" label="description de la taches" />
        </x-form>
    </x-modal>
</div>
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