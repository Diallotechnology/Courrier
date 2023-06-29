@props(['row','url' => ''])
@can('restore', $row)
@if ($url)
<button type="button" {{ $attributes->merge(['class' => 'btn btn-danger btn-icon']) }} onclick="restore('{{ $url }}')">
    <i class="ti ti-rotate-clockwise"></i>
</button>
@endif
@endcan