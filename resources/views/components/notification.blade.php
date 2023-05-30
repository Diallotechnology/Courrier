<a href="?theme=dark" {{ $attributes->merge(['class' => 'nav-link px-0 hide-theme-dark']) }} {{
    $attributes->merge(['title' => 'Enable dark mode']) }} data-bs-toggle="tooltip" data-bs-placement="bottom">
    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
    </svg>
</a>
<a href="?theme=light" {{ $attributes->merge(['class' => 'nav-link px-0 hide-theme-light']) }} {{
    $attributes->merge(['title' => 'Enable light mode']) }} data-bs-toggle="tooltip" data-bs-placement="bottom">
    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
        <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
    </svg>
</a>

<div {{ $attributes->merge(['class' => 'nav-item dropdown d-none d-md-flex me-3']) }}>
    <a href="#" {{ $attributes->merge(['class' => 'nav-link px-0']) }} data-bs-toggle="dropdown" tabindex="-1"
        aria-label="Show notifications">
        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
        </svg>

        @if (Auth::user()->notifications->isNotEmpty())
        <span {{ $attributes->merge(['class' => 'badge bg-red']) }} ></span>
        @endif
    </a>

    <div {{ $attributes->merge(['class' => 'dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card'])
        }}>
        <div {{ $attributes->merge(['class' => 'card']) }} >
            @livewire('notif')

        </div>
    </div>
</div>