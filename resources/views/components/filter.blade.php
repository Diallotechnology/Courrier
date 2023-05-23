@props(['btn'=>'','btn_filter'=> true, 'url' => '', 'trash'=>'', 'create' => true])
<div {{ $attributes->merge(['class' => 'd-flex']) }} >
    <div {{ $attributes->merge(['class' => 'text-muted']) }} >
        <div {{ $attributes->merge(['class' => 'ms-2 d-inline-block']) }} >
            <div {{ $attributes->merge(['class' => 'input-icon']) }} >
                <span {{ $attributes->merge(['class' => 'input-icon-addon']) }} >
                    <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
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
        @empty(!$btn)
        @if($btn_filter)
        <button {{ $attributes->merge(['class' => 'btn btn-indigo mx-2']) }} {{ $attributes->merge(['type' => 'button'])
            }} data-bs-toggle="collapse" data-bs-target="#collapse-1"
            aria-expanded="true">
            <i class="ti ti-filter"></i>
            Filtre Avancer
        </button>
        @endif
        @endempty

    </div>
    <div {{ $attributes->merge(['class' => 'ms-auto text-muted']) }} >
        @if($create)
        <x-button-modal />
        @endif
        @empty(!$trash)
        <a href="{{ route($trash) }}" {{ $attributes->merge(['class' => 'btn btn-primary']) }} aria-label="Button">
            <i class="ti ti-list"></i>Liste</a>

        <button {{ $attributes->merge(['class' => 'btn btn-red']) }} onclick="trash_delete('delete')"
            data-bs-toggle="modal" data-bs-target="#modal-danger" aria-label="Button">
            <i class="ti ti-trash"></i>Tout supprimer
        </button>

        <button {{ $attributes->merge(['class' => 'btn btn-green']) }} {{ $attributes->merge(['type' => 'button']) }}
            data-bs-toggle="modal" data-bs-target="#modal-danger"
            aria-label="Button" onclick="trash_delete('restore')" >
            <i class="ti ti-rotate-clockwise"></i>Tout restaure
        </button>
        @endempty

        @empty(!$url)
        <a aria-label="Button" href="{{ route($url.'.trash') }}" {{ $attributes->merge(['class' => 'btn
            btn-red'])
            }}>
            <i class="ti ti-trash-x"></i>Corbeille</a>
        @endempty
        {{ $btn }}

    </div>
</div>
@empty(!$btn)
<div wire:ignore>
    <div {{ $attributes->merge(['class' => 'accordion']) }} id="accordion-example">
        <div {{ $attributes->merge(['class' => 'accordion-item border-0']) }} >
            <div {{ $attributes->merge(['class' => 'accordion-collapse collapse']) }} id="collapse-1"
                data-bs-parent="#accordion-example" >
                <div {{ $attributes->merge(['class' => 'accordion-body pt-4 px-2']) }} >
                    <div {{ $attributes->merge(['class' => 'row row-cards']) }} >
                        {{ $slot }}
                    </div>
                    <button wire:click='ResetFilter' {{ $attributes->merge(['class' => 'btn btn-danger mx-2']) }}
                        type="button">
                        <i class="ti ti-file-export"></i>
                        Reset Filtres
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endempty

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
    function trash_delete(params) {
    if (params === "restore") {
        $(".restore").css("display","block");
        $(".delete").css("display","none");
    }

    if (params === "delete") {
        $(".delete").css("display","block");
        $(".restore").css("display","none");
    }
}
</script>