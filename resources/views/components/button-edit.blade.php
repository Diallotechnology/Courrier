@props(['row'])
@can('update', $row)
<a wire:navigate aria-label="Button" {{ $attributes->merge(['class' => 'btn btn-primary btn-icon']) }}>
    <i class="ti ti-edit"></i></a>
@endcan