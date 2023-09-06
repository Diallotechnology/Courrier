@props(['title', 'lancher' => 'modal', 'size' => ''])

<div {{ $attributes->merge(['class' => 'modal modal-blur fade']) }} id="{{ $lancher }}" tabindex="-1" role="dialog"
    aria-hidden="true" data-bs-backdrop="static">
    <div {{ $attributes->merge(['class' => "modal-dialog modal-dialog-centered $size"]) }}
        role="document">
        <div {{ $attributes->merge(['class' => 'modal-content']) }} >
            <div {{ $attributes->merge(['class' => 'modal-header']) }} >
                <h5 {{ $attributes->merge(['class' => 'modal-title']) }} >Formulaire de {{ $title }}</h5>
                <button {{ $attributes->merge(['class' => 'btn-close']) }} {{ $attributes->merge(['type' => 'button'])
                    }} data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div {{ $attributes->merge(['class' => 'modal-body']) }} >
                {{ $slot }}
            </div>
        </div>
    </div>
</div>