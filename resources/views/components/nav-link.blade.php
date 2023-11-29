@props(['url'=>''])
@php
$classes = Route::currentRouteName() == $url ? 'nav-item active' : 'nav-item';
@endphp
<li {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ route($url) }}" {{ $attributes->merge(['class' => "nav-link"]) }} >
        {{ $slot }}
    </a>
</li>