<div>
    <div>
        <div class="card-header">
            <div class="my-2 d-flex">
                <div class="m-2 d-inline-block">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                        </span>
                        <input class="form-control" type="text" wire:model.live.debounce='search' id="search-input"
                            placeholder="Recherche…" aria-label="Search in website">
                    </div>

                </div>
            </div>
            <div wire:ignore>
                <div class="mx-2">
                    <select class="form-select select-tags" wire:model.live='type' value="">
                        <option selected disabled value="">Trier par type de dossier</option>
                        <option value="Courrier Arrivé">Courrier Arrivé</option>
                        <option value="Courrier Depart">Courrier Depart</option>
                        <option value="Courrier Interne">Courrier Interne</option>
                        <option value="Rapport">Rapport</option>
                    </select>
                </div>
            </div>
            <div wire:ignore>
                <select class="form-select select-tags" wire:model.live='date' value="">
                    <option selected disabled value="">Trier par date</option>
                    <option value="desc">le plus recent</option>
                    <option value="asc">le plus ancien</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div wire:loading>
                <div class="text-center justify-content-center">
                    <h1 class="text-center">Loading<span class="animated-dots"></span></h1>
                </div>
            </div>
            @forelse ($rows as $row)
            <div wire:key="{{ $row->id }}" class="col-md-3">
                <a class="nav-link" style="display: initial;" href="{{ route('folder.show', ['folder' => $row]) }}">
                    <div class="card text-center mb-2 shadow">
                        <div class="card-body file">
                            <div class="rounded my-4">
                                <span style="
                        font-size: 44PX;
                        background-color: #f8f9fa;
                        border-radius: 55px;
                        padding: 12px;" class="ti ti-folder-filled text-blue"></span>
                            </div>
                        </div> <!-- .card-body -->
                        <div class="card-footer bg-transparent border-0 fname">
                            <strong>Nom: {{ $row->nom }}</strong> <br>
                            <strong>Type de dossier: {{ $row->type }}</strong> <br>
                            <strong>Taille: {{ $row->documents_count }} fichiers</strong> <br>
                            <strong>Date de creation {{ $row->created_at }}</strong>
                        </div> <!-- .card-footer -->
                    </div> <!-- .card -->
                </a>
            </div>
            @empty
            <h1 class="my-5 text-center">Aucun dossier</h1>
            @endforelse
            {{ $rows->links() }}
        </div>
    </div>
</div>