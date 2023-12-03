@props(['title' => '', 'link','url'])


<li {{ $attributes->merge(['class' => 'nav-item dropdown']) }} >
    <a {{ $attributes->merge(['class' => 'nav-link dropdown-toggle']) }} href="#{{ $title }}"
        data-bs-toggle="dropdown"
        data-bs-auto-close="false"
        role="button" aria-expanded="false"
        >
        <span {{ $attributes->merge(['class' => 'nav-link-icon d-md-none d-lg-inline-block']) }} >
            {{ $slot }}
        </span>
        <span {{ $attributes->merge(['class' => 'nav-link-title']) }} >{{ $title }}</span>
    </a>
    <div {{ $attributes->merge(['class' => 'dropdown-menu']) }}>
        <div {{ $attributes->merge(['class' => 'dropdown-menu-columns']) }}>
            <div {{ $attributes->merge(['class' => 'dropdown-menu-column']) }}>
                {{ $link }}
            </div>
        </div>
    </div>
</li>


{{-- @props(['title' => '', 'link', 'url'])

<div x-data="{ open: false }" @click.away="open = false" class="nav-item dropdown">
    <!-- Dropdown toggle link -->
    <a x-on:click="open = !open" class="nav-link dropdown-toggle" href="#{{ $title }}" role="button"
        aria-expanded="false">
        <!-- Icon for the dropdown -->
        <span class="nav-link-icon d-md-none d-lg-inline-block">{{ $slot }}</span>
        <!-- Title for the dropdown -->
        <span class="nav-link-title">{{ $title }}</span>
    </a>

    <!-- Dropdown menu -->
    <div x-show.important="open" class="dropdown-menu">
        <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column">
                <!-- Links for the dropdown -->
                {{ $link }}
            </div>
        </div>
    </div>
</div> --}}