<div>
    <div class="card-header">
        <div class="my-2">
            <div class="ms-2 d-inline-block" >
                <div class="input-icon" >
                    <span class="input-icon-addon" >
                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </span>
                    <input class="form-control" type="text" wire:model.debounce='search'
                    id="search-input" placeholder="Recherche…"
                    aria-label="Search in website">
                </div>
            </div>
        </div>
      {{-- <ul class="nav nav-tabs card-header-tabs flex-row-reverse" data-bs-toggle="tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a href="#tabs-profile-2" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"><i class="ti ti-category text-blue"></i></a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#tabs-home-2" class="nav-link" data-bs-toggle="tab" aria-selected="true" role="tab"><i class="ti ti-list"></i></a>
          </li>
      </ul> --}}
    </div>
    <div class="card-body">
        <div class="row">
            @forelse ($folder as $row)
            <div class="col-md-3">
            <a class="nav-link" style="display: initial;" href="{{ route('folder.show', ['folder' => $row]) }}">
            <div class="card text-center mb-2 shadow">
                <div class="card-body file">
                    <div class="rounded my-4">
                        <span style="
                        font-size: 44PX;
                        background-color: #f8f9fa;
                        border-radius: 55px;
                        padding: 12px;
                    " class="ti ti-folder-filled text-blue"></span>
                    </div>

                </div> <!-- .card-body -->
                <div class="card-footer bg-transparent border-0 fname">
                    <strong>{{ $row->nom }}</strong> <br>
                    <strong>{{ $row->documents_count }} fichiers</strong> <br>
                    <strong>Date de creation {{ $row->created_at }}</strong>
                </div> <!-- .card-footer -->
            </div> <!-- .card -->
        </a>
        </div>
            @empty
            <h3>Aucun dossier</h3>
            @endforelse
            @if($folder)
            {{ $folder->links() }}
            @endif
        </div>
      {{-- <div class="tab-content">
        <div class="tab-pane" id="tabs-home-2" role="tabpanel">
          <x-table :rows="$rows">
            <x-slot name="header">
                <div class="card-body">
                    <x-filter url="document" :create="App\Models\Document::class" />
                </div>
            </x-slot>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Dossier</th>
                    <th>Libelle</th>
                    <th>extension</th>
                    <th>type</th>
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
                    <td>{{ $row->type }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                        <x-button-download :row="$row" href="{{ route('document.download', ['document' => $row]) }}" />
                        <x-button-edit :row="$row" href="{{ route('document.edit', ['document' => $row]) }}" />
                        <x-button-show :row="$row" href="{{ route('document.show', ['document' => $row]) }}" target="_blank" />
                        <x-button-delete :row="$row" url="{{ url('document/'.$row->id) }}" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-table>
        </div>
        <div class="tab-pane active show" id="tabs-profile-2" role="tabpanel">

        </div>
      </div> --}}
    </div>
</div>
