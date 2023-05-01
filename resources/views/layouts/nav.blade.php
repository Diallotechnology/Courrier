<div class="collapse navbar-collapse" id="sidebar-menu">
  <ul class="navbar-nav pt-lg-3">
    <x-nav-link url="dashboard">
      <span class="nav-link-icon d-md-none d-lg-inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
          <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
          <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
       </svg>
      </span>
      <span class="nav-link-title">
        Dashboard
      </span>
    </x-nav-link>

    <x-dropdown title="Courrier">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
          <path d="M3 7l9 6l9 -6"></path>
       </svg>
      <x-slot name="link">
        <a class="dropdown-item" href="#">Arriver</a>
        <a class="dropdown-item" href="#">Sent</a>
      </x-slot>
    </x-dropdown>
  </ul>
</div>