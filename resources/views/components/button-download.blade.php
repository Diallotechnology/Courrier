@props(['row'])
@can('download', $row)
<a wire:navigate aria-label="Button" {{ $attributes->merge(['class' => 'btn btn-indigo btn-icon']) }}>
    <i class="ti ti-download"></i></a>
@endcan