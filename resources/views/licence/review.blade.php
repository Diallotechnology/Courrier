<x-guest-layout>
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="/" class="navbar-brand navbar-brand-autodark"><img src="{{ asset('img/logo/logo_black.png') }}" style="height: 6rem;" alt="logo"></a>
        </div>
        <div class="card card p-2">
            <div class="card-body">
                <h2 class="mb-3">Renouvelement de licence</h2>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <p class="text-muted mb-2">Choississez un abonnement qui vous convient</p>
                <p class="text-muted mb-2">NB: après l'achat de la licence vous allez recevoir un email de confirmation avec la facture</p>
                <form novalidate action="{{ route('licence.active',Auth::user()->user_structure()) }}" class="needs-validation" method="post">
                    @csrf
                    @method('PATCH')
                    <x-select name="temps" label="temps">
                        <option value="3">3 mois</option>
                        <option value="6">6 mois</option>
                        <option value="12">1 an</option>
                    </x-select>
                    <div class="text-center mt-4">
                        <a href="{{ route('licence_expire') }}" class="btn btn-danger me-auto" role="button">Annuler</a>
                        <button class="btn btn-primary" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
