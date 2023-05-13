@props(['url' => '', 'title' => 'Supprimer?', 'message' => 'Etes vous sur de vouloir restauré cet element!',
'confirmText' => 'Oui, Restauré!', 'cancelText' => 'Non, Annuler!'])

@if ($url)
<button type="button" {{ $attributes->merge(['class' => 'btn btn-danger btn-icon']) }}
    onclick="restore('{{ $url }}', '{{ $title }}', '{{ $message }}', '{{ $confirmText }}', '{{ $cancelText
    }}')"><i class="ti ti-rotate-clockwise"></i></button>
@endif
