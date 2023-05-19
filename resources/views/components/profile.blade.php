<div {{ $attributes->merge(['class' => 'nav-item dropdown']) }} >
    <a {{ $attributes->merge(['class' => 'nav-link d-flex lh-1 text-reset p-0']) }} href="#" data-bs-toggle="dropdown"
        aria-label="Open user menu">
        <span {{ $attributes->merge(['class' => 'avatar avatar-sm']) }}
            style="background-image: url(./static/avatars/000m.jpg)"></span>
        <div {{ $attributes->merge(['class' => 'd-none d-xl-block ps-2']) }} >
            <div>{{ Auth::user()->name }}</div>
            <div {{ $attributes->merge(['class' => 'mt-1 small text-muted']) }} >{{ Auth::user()->email }}</div>
        </div>
    </a>
    <div {{ $attributes->merge(['class' => 'dropdown-menu dropdown-menu-end dropdown-menu-arrow']) }} >
        <a href="" {{ $attributes->merge(['class' => 'dropdown-item']) }} >Profile</a>
        <div {{ $attributes->merge(['class' => 'dropdown-divider']) }} ></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Deconnexion</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        </form>
    </div>
</div>