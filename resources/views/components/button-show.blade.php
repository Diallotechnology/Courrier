@props(['row'])
@can('view', $row)
<a aria-label="Button" {{ $attributes->merge(['class' => 'btn btn-success btn-icon']) }}>
    <i class="ti ti-eye"></i></a>
@endcan