@props(['title' => '', 'link','url'])
<li {{ $attributes->merge(['class' => 'nav-item dropdown']) }} >
    <a {{ $attributes->merge(['class' => 'nav-link dropdown-toggle']) }}  href="#{{ $title }}" data-bs-toggle="dropdown" data-bs-auto-close="false"
      role="button" aria-expanded="false">
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