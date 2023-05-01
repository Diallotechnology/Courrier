@props(['title'])
<div {{ $attributes->merge(['class' => 'modal modal-blur fade']) }}  id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div {{ $attributes->merge(['class' => 'modal-dialog modal-dialog-centered']) }}  role="document">
      <div {{ $attributes->merge(['class' => 'modal-content']) }} >
        <div {{ $attributes->merge(['class' => 'modal-header']) }} >
          <h5 {{ $attributes->merge(['class' => 'modal-title']) }} >{{ $title }}</h5>
          <button {{ $attributes->merge(['class' => 'btn-close']) }} {{ $attributes->merge(['type' => 'button']) }}  data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div {{ $attributes->merge(['class' => 'modal-body']) }} >
            {{ $slot }}
        </div>
        <div {{ $attributes->merge(['class' => 'modal-footer']) }} >
          <button {{ $attributes->merge(['class' => 'btn me-auto']) }}  {{ $attributes->merge(['type' => 'button']) }} data-bs-dismiss="modal">Fermer</button>
          <button {{ $attributes->merge(['class' => 'btn btn-primary']) }} {{ $attributes->merge(['type' => 'button']) }} data-bs-dismiss="modal">Valider</button>
        </div>
      </div>
    </div>
  </div>