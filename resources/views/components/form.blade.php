@props(['type'=>'create','url','route'])
@if($type === "update")
<h2 class="mb-3 text-center">Formulaire de mise à jour</h2>
@endif
<form novalidate action="{{ $route }}" {{ $attributes->merge(['class' => 'needs-validation']) }} method="post">
    @csrf
    <div class="row">
        {{ $slot }}
    </div>
    @if($type === "update")
    @method('PATCH')
    @endif

    <div class="text-center mt-4">

        @if($type === "update")
        <a href="{{ $url }}" {{ $attributes->merge(['class' => 'btn btn-danger me-auto']) }} {{
            $attributes->merge(['role' => 'button'])
            }}>Annuler</a>
        @else
        <button {{ $attributes->merge(['class' => 'btn btn-danger me-auto']) }} {{
            $attributes->merge(['type' =>
            'button'])
            }} data-bs-dismiss="modal">Fermer</button>
        @endif
        <button {{ $attributes->merge(['class' => 'btn btn-primary']) }} {{ $attributes->merge(['type' =>
            'submit']) }}>Valider</button>
    </div>
</form>
