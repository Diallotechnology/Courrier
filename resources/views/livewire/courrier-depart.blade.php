<div>
    @section('header')
    <div class="col">
        <div class="mb-1">
            <ol class="breadcrumb" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Courrier depart</a></li>
            </ol>
        </div>
        <h2 class="page-title">
            <span class="text-truncate">Liste des courriers depart</span>
        </h2>
    </div>
    @endsection
    @section('content')
    <x-table :rows="$rows" url="depart" :create="App\Models\Depart::class">
        <x-slot name="filter">
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Nature de courrier" wire:model.live='nature'>
                        @foreach ($type as $row)
                        <option value="{{ $row->id }}">{{ $row->nom }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Initiateur" wire:model.live='initiateur'>
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
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Correspondant" wire:model.live='expediteur'>
                        @foreach ($correspondant as $row)
                        <option value="{{ $row->id }}">{{ $row->prenom }} {{ $row->nom }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Priorite" wire:model.live='priority'>
                        <option value="Urgent">Urgent</option>
                        <option value="Normal">Normal</option>
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <div wire:ignore>
                    <x-select label="Confidentialité" wire:model.live='privacy'>
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                    </x-select>
                </div>
            </div>
            <div class="col-sm-4 col-md-2">
                <x-input type="date" label="Date depart" wire:model.live='date' />
            </div>

            <x-slot name="btn">
                <button type="button" class="btn btn-indigo dropdown-toggle" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-database-export"></i>
                    Exporté
                </button>
                <div class="dropdown-menu" style="">
                    <button wire:click='export' class="dropdown-item">Excel</button>
                </div>
            </x-slot>
        </x-slot>
        <thead>
            <tr>
                <th>ID</th>
                <th>Structure</th>
                <th>Utilisateur</th>
                <th>Initiateur</th>
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
            <tr wire:key="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->structure_view() }}</td>
                <td>
                    <x-user-avatar :row="$row" />
                </td>
                <td>
                    <x-custom-avatar :row="$row->initiateur" />
                </td>
                <td>{{ $row->numero }}</td>
                <td>
                    {{ $row->date_format }}
                </td>
                <td>{{ $row->nature_view() }}</td>
                <td>
                    @forelse ($row->correspondants as $item)
                    <div wire:key="{{ $item->id }}"> {{ $item->nom }}</div>
                    @empty
                    aucun
                    @endforelse
                </td>

                <td>{{ $row->courrier ? 'Courrier N°'. $row->courrier->numero : 'pas de reponse' }}</td>

                <td>
                    <x-statut type="prio" :courrier="$row" />
                </td>
                <td>
                    <x-statut type="privacy" :courrier="$row" />
                </td>
                <td>
                    <span @class(['status', 'status-info'=> $row->Register(),
                        'status-success' => $row->Send()
                        ])>{{ $row->etat }}</span>
                </td>
                <td>
                    <p class="text-muted">{{ $row->objet }}</p>
                </td>
                <td>{{ $row->created_at }}</td>
                <td>
                    @if ($row->folder)
                    <x-button-folder href="{{ route('folder.show', ['folder' => $row->folder]) }}" />
                    @endif
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
                    <x-select name="nature_id" label="Nature du courrier">
                        @foreach ($type as $row)
                        <option @selected(old('nature_id')==$row->id) value="{{ $row->id }}">{{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-6">
                    <x-select name="correspondant_id[]" multiple label="Correspondants (Destinateurs)">
                        @foreach ($correspondant as $row)
                        <option @selected(old('correspondant_id')==$row->id) value="{{ $row->id }}">{{ $row->nom }}
                        </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="col-md-3">
                    <x-select name="priorite" label="Priorité">
                        <option @selected(old('priorite')=="Normal" ) value="Normal">Normal</option>
                        <option @selected(old('priorite')=="Urgent" ) value="Urgent">Urgent</option>
                    </x-select>
                </div>
                <div class="col-md-3">
                    <x-select name="confidentiel" label="confidentiel">
                        <option @selected(old('confidentiel')==="OUI" ) value="OUI">OUI</option>
                        <option @selected(old('confidentiel')==="NON" ) value="NON">NON</option>
                    </x-select>
                </div>
                <div class="col-md-6">
                    <x-select name="initiateur_id" label="Personne Initiateur">
                        @foreach ($user as $key => $row)
                        <optgroup label="Departement {{ $key }}">
                            @foreach ($row as $item)
                            <option @selected(old('initiateur_id')==$item->id) data-custom-properties="&lt;span
                                class=&quot;avatar avatar-xs&quot; style=&quot;background-image:
                                url('https://ui-avatars.com/api/?background=random&bold=true&name={{ $item->name
                                }}')&quot;&gt;&lt;/span&gt;" value="{{ $item->id }}">{{ $item->email }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
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
                        label="CE COURRIER SORTANT RÉPOND-T-IL À UN COURRIER Arrivé? FACULTATIF">
                        @foreach ($courrier as $row)
                        <option @selected(old('courrier_id')==$row->id) value="{{ $row->id }}">Reference {{
                            $row->reference
                            }}, N° {{ $row->numero }}, Date
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
    @endsection

</div>