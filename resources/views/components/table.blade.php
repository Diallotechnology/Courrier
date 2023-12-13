@props(['header' => '', 'filter' => '', 'rows' => '', 'btn'=> false,'btn_filter'=> true, 'btn_export' => false, 'url' =>
'', 'trash'=>'',
'create' =>
""])
<div class="col-12">
    <div class="row">
        <div class="col">
            <div class="card-header">
                {{ $header }}
            </div>
        </div>
        <div {{ $attributes->merge(['class' => 'col-auto mt-2']) }} >
            @can('create',$create)
            <x-button-modal />
            @if ($create === "App\Models\SubDepartement::class")
            <button class="btn btn-blue mx-2" type="button" data-bs-toggle="modal" data-bs-target="#user">
                <i class="ti ti-plus"></i>
                Utilisateur
            </button>
            @endif

            @endcan
            @if ($btn)
            {{ $btn }}
            @endif
            @empty(!$trash)
            <a wire:navigate href="{{ route($trash) }}" {{ $attributes->merge(['class' => 'btn btn-primary']) }}
                aria-label="Button">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-arrow-left"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 21a9 9 0 1 0 0 -18a9 9 0 0 0 0 18" />
                    <path d="M8 12l4 4" />
                    <path d="M8 12h8" />
                    <path d="M12 8l-4 4" />
                </svg>
                Retour
            </a>

            <button {{ $attributes->merge(['class' => 'btn btn-red']) }} onclick="trashDelete('delete')"
                data-bs-toggle="modal" data-bs-target="#modal-danger" aria-label="Button">
                <i class="ti ti-trash"></i>Tout supprimer
            </button>

            <button {{ $attributes->merge(['class' => 'btn btn-green']) }} {{ $attributes->merge(['type' => 'button'])
                }}
                data-bs-toggle="modal" data-bs-target="#modal-danger"
                aria-label="Button" onclick="trashDelete('restore')" >
                <i class="ti ti-rotate-clockwise"></i>Tout restaure
            </button>
            @endempty
            @if ($btn_export)
            <button type="button" class="btn btn-indigo dropdown-toggle mx-2" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-database-export"></i>
                Exporter
            </button>
            <div class="dropdown-menu">
                <button wire:click='export' class="dropdown-item">Excel</button>
            </div>
            @endif
            @empty(!$url)
            @can('trash',$create)
            <a wire:navigate aria-label="Button" href="{{ route($url.'.trash') }}" {{ $attributes->merge(['class' =>
                'btn
                btn-red'])
                }}>
                <i class="ti ti-trash-x"></i>Corbeille</a>
            @endcan
            @endempty

        </div>
    </div>
    @if ($btn_filter)
    <div class="card my-3">
        <div class="card-body">
            <div {{ $attributes->merge(['class' => 'd-flex']) }} >
                <div {{ $attributes->merge(['class' => 'text-muted']) }} >
                    <div {{ $attributes->merge(['class' => 'ms-2 d-inline-block']) }} >
                        <div {{ $attributes->merge(['class' => 'input-icon']) }} >
                            <span {{ $attributes->merge(['class' => 'input-icon-addon']) }} >
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </span>
                            <input {{ $attributes->merge(['class' => 'form-control']) }} type="text" value=""
                            id="search-input" placeholder="Recherche…"
                            aria-label="Search in website">
                        </div>
                    </div>
                </div>
            </div>
            @empty(!$filter)
            <div {{ $attributes->merge(['class' => 'row row-cards mt-3']) }} >
                {{ $filter }}
            </div>
            <button wire:click='ResetFilter' {{ $attributes->merge(['class' => 'btn btn-danger mx-2']) }}
                type="button">
                <i class="ti ti-file-export"></i>
                Reset Filtres
            </button>
            @endempty
        </div>
    </div>
    @endif
    <div class="card">
        <div wire:loading>
            <div class="text-center justify-content-center">
                <h1 class="text-center">Loading<span class="animated-dots"></span></h1>
            </div>
        </div>
        <div {{ $attributes->merge(['class' => 'table-responsive']) }}>
            <div wire:loading.remove>
                <table id="datatable" {{ $attributes->merge(['class' => 'table card-table table-vcenter text-nowrap
                    datatable']) }}>
                    {{ $slot }}
                    <h3 id="no-results" class="text-center " style="display:none;">Aucun resultat trouvé.</h3>
                </table>
            </div>
        </div>

        <div class="card-footer align-items-center">
            @if($rows)
            {{ $rows->links() }}
            @endif
        </div>
    </div>
</div>
@empty(!$trash)
<div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 9v2m0 4v.01" />
                    <path
                        d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                </svg>
                <h3>Etes vous sur ?</h3>
                <div class="text-muted restore" style="display: none;">Etes vous sur de vouloir restaurer tous les
                    elements.</div>
                <div class="text-muted delete" style="display: none;">Etes vous sur de vouloir supprimer
                    definitivement tous les
                    elements.
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                Non, Annuler!
                            </a></div>

                        <div class="col">
                            <a href="{{ route($trash.'.restore') }}" class="btn btn-danger w-100 restore">
                                Oui, Restaurer!
                            </a>
                            <a href="{{ route($trash.'.delete') }}" class="btn btn-danger w-100 delete">
                                Oui, Supprimer!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endempty
<script>
    function trashDelete(params) {
    var restoreElements = document.querySelectorAll(".restore");
    var deleteElements = document.querySelectorAll(".delete");

    if (params === "restore") {
        restoreElements.forEach(function(element) {
            element.style.display = "block";
        });
        deleteElements.forEach(function(element) {
            element.style.display = "none";
        });
    }

    if (params === "delete") {
        deleteElements.forEach(function(element) {
            element.style.display = "block";
        });
        restoreElements.forEach(function(element) {
            element.style.display = "none";
        });
    }
}
</script>