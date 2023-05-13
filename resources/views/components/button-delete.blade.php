@props(['url' => '', 'title' => 'Supprimer?', 'message' => 'Etes vous sur de vouloir supprimer cet element!',
'confirmText' => 'Oui, Supprimer!', 'cancelText' => 'Non, Annuler!'])

@if ($url)
<button type="button" {{ $attributes->merge(['class' => 'btn btn-danger btn-icon']) }}
    onclick="deleteConfirmation('{{ $url }}', '{{ $title }}', '{{ $message }}', '{{ $confirmText }}', '{{ $cancelText
    }}')"><i class="ti ti-trash"></i></button>
@endif
