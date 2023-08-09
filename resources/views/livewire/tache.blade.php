<div>
    <div class="row row-deck row-cards mb-3">
        <div class="col-12">
            <div class="row row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3.5 5.5l1.5 1.5l2.5 -2.5"></path>
                                            <path d="M3.5 11.5l1.5 1.5l2.5 -2.5"></path>
                                            <path d="M3.5 17.5l1.5 1.5l2.5 -2.5"></path>
                                            <path d="M11 6l9 0"></path>
                                            <path d="M11 12l9 0"></path>
                                            <path d="M11 18l9 0"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total Taches
                                    </div>
                                    <div class="text-muted">
                                        {{ count(Auth::user()->createurs) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 12l5 5l10 -10"></path>
                                            <path d="M2 12l5 5m5 -5l5 -5"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total Taches Terminé
                                    </div>
                                    <div class="text-muted">
                                        {{ count(Auth::user()->createurs->where('etat',App\Enum\TaskEnum::TERMINE)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                            <path d="M5.7 5.7l12.6 12.6"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total Taches Inachevé
                                    </div>
                                    <div class="text-muted">
                                        {{ count(Auth::user()->createurs->where('etat',App\Enum\TaskEnum::NON_TERMINE))
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 6l0 -3"></path>
                                            <path d="M16.25 7.75l2.15 -2.15"></path>
                                            <path d="M18 12l3 0"></path>
                                            <path d="M16.25 16.25l2.15 2.15"></path>
                                            <path d="M12 18l0 3"></path>
                                            <path d="M7.75 16.25l-2.15 2.15"></path>
                                            <path d="M6 12l-3 0"></path>
                                            <path d="M7.75 7.75l-2.15 -2.15"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Total taches en attente
                                    </div>
                                    <div class="text-muted">
                                        {{ count(Auth::user()->createurs->where('etat',App\Enum\TaskEnum::EN_ATTENTE))
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-table :rows="$rows">
        <x-slot name="header">
            <div class="card-body">
                <x-filter url="task" :create="App\Models\Task::class">
                    <div class="mb-3 col-sm-4 col-md-3">
                        <div wire:ignore>
                            <x-select label="imputation" :required='false' wire:model='imputation'>
                                @foreach ($imp as $row)
                                <option value="{{ $row->id }}">Reference {{ $row->numero }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
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
                <th>Exécutant</th>
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
                <td><x-custom-avatar :row="$row->createur" /></td>
                <td>{{ $row->numero }}</td>
                <td>{{ $row->type }}</td>
                <td>
                    @forelse ($row->users as $item)
                    <div>
                        @if($item->pivot->etat == true)
                        <i class="ti ti-checks"></i>
                        @endif
                        {{ $item->email }}
                    </div>
                    {{-- <div class="mb-2">Departement {{ $item->userable->nom }}
                    </div> --}}
                    @empty
                @if($row->type === "imputation")
                <a role="button" href="{{ route('task.show', ['task' => $row]) }}" class="btn btn-indigo ">
                    <i class="ti ti-user"></i> assigner
                </a>
                @endif
                @endforelse
                </td>
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

                    @if(!$row->Pending() && !$row->Complet() && auth()->user()->tasks->contains($row) &&
                    auth()->user()->pivot_values->contains($row))
                    <button type="button" wire:click="ValidTask({{ $row->id }})" class="btn btn-indigo btn-icon">
                        <i class="ti ti-checks"></i>
                    </button>
                    @endif
                    <x-button-edit :row="$row" href="{{ route('task.edit', ['task' => $row]) }}" />
                    <x-button-show :row="$row" href="{{ route('task.show', ['task' => $row]) }}" />
                    <x-button-delete :row="$row" url="{{ url('task/'.$row->id) }}" />
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
<x-modal title="nouvelle tache">
    <div wire:ignore>
        <x-form route="{{ route('task.store') }}">
            <div class="col-md-6">
                <x-input type="text" name="nom" place="le nom de la tache" />
            </div>
            <div class="col-md-6">
                <div wire:ignore>
                    <x-select name="type" id="type" label="type de tache">
                        <option @selected(Auth::user()->isStandard()) value="utilisateur">Utilisateur</option>
                        @if(!Auth::user()->isStandard())
                        <option value="imputation">Imputation</option>
                        @endif
                    </x-select>
                </div>
            </div>
            @if(!Auth::user()->isStandard())
            <h3 class="my-2">Si cette tâche concerne une imputation.</h3>
            <div class="col-md-12">
                <div wire:ignore>
                    <x-select name="imputation_id" :required="false" label="liste des imputations ">
                        @foreach ($imp as $item)
                        <option @selected(old('imputation_id')==$item->id) value="{{ $item->id }}">imputation N°{{ $item->numero }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            @endif
            <div class="col-md-12">
                <div wire:ignore>
                    <x-select name="user_id[]" multiple label="liste des Utilisateurs exécuteur">
                        @foreach ($user as $key => $row)
                        <optgroup label="Departement {{ $key }}">
                            @foreach ($row as $item)
                            <option data-custom-properties="&lt;span class=&quot;avatar avatar-xs&quot;  style=&quot;background-image: url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $item->name }}')&quot;&gt;&lt;/span&gt;" value="{{ $item->id }}">{{ $item->email }}</option>
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
    </div>
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
