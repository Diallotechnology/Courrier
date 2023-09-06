@props(['url'=>''])
<li {{ $attributes->merge(['class' => "nav-item"]) }}>
    <a href="{{ route($url) }}" {{ $attributes->merge(['class' => "nav-link"]) }} wire:navigate >
        {{ $slot }}
    </a>
</li>