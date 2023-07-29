<x-guest-layout>
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="/" class="navbar-brand navbar-brand-autodark"><img src="{{ asset('img/logo/logo_black.png') }}" style="height: 6rem;" alt="logo"></a>
        </div>
        <div class="card card p-2">
            <div class="card-body">
                <h2 class="mb-3">{{ $message }}</h2>
                <p class="text-muted mb-4">
                    Si vous souhaitez continuer à utiliser de courribox,veuillez mettre à niveau votre licence.
                </p>
                <div class="my-4">
                    <a href="{{ route('licence.review') }}" role="button" class="btn btn-primary w-100">Renouvelé votre licence</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
