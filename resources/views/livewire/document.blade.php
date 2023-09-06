<div>
    <x-table>
        <x-slot name="header">
            <div class="card-body">
                <x-filter url="document" :create="App\Models\Document::class">
                    <div class="col-md-4 mb-3">
                        <div wire:ignore>
                            <select class="form-select select-tags" wire:model.live='type'>
                                <option selected disabled value="">Trier par type</option>
                                <option value="pdf">pdf</option>
                                <option value="png">png</option>
                                <option value="jpg">jpg</option>
                                <option value="doc">doc</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div wire:ignore>
                            <select class="form-select select-tags" wire:model.live='date' value="">
                                <option selected disabled value="">Trier par date</option>
                                <option value="desc">le plus recent</option>
                                <option value="asc">le plus ancien</option>
                            </select>
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
                <th>nom du Dossier</th>
                <th>Libelle</th>
                <th>extension</th>
                <th>Date de creation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>
                    <x-user-avatar :row="$row" />
                </td>
                <td>{{ $row->folder->nom }}</td>
                <td>{{ $row->libelle }}</td>
                <td>{{ $row->extension }}</td>
                <td>{{ $row->created_at }}</td>
                <td>
                    <x-button-download :row="$row" href="{{ route('document.download', ['document' => $row]) }}" />
                    <x-button-edit :row="$row" href="{{ route('document.edit', ['document' => $row]) }}" />
                    <x-button-show :row="$row" href="{{ route('document.show', ['document' => $row]) }}"
                        target="_blank" />
                    <x-button-delete :row="$row" url="{{ url('document/'.$row->id) }}" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </x-table>
</div>