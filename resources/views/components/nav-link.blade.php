@props(['url'=>''])
@php
$classes = Route::currentRouteName() == $url ? 'nav-item active' : 'nav-item';
@endphp
<li {{ $attributes->merge(['class' => $classes]) }}>
    <a wire:navigate href="{{ route($url) }}" {{ $attributes->merge(['class' => "nav-link"]) }} >
        {{ $slot }}
    </a>
</li>