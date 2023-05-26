<x-guest-layout>
    <div class="container container-tight py-2">
        <div class="text-center mb-4">
            <x-logo />
        </div>
        <form class="card card-md needs-validation" action="{{ route('2fa_verify') }}" method="post" autocomplete="off"
            novalidate>
            @error('code')
            <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 8v4"></path>
                            <path d="M12 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
            @enderror
            @csrf
            <div class="card-body">
                <div class="col-12">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">L’authentification à deux facteurs (2FA)</h2>
                        <p class="text-muted mb-4">Entrez le code que vous avez reçu par email pour valider votre
                            identité
                        </p>
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <input type="number" name="code" required class="form-control" placeholder="Entrez le code">
                        </div>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">Ce champ est obligatoire.</div>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Valider</button>
                </div>
                @if (Session::has('two_factor:user_id'))
                <div class="text-center text-muted mt-3">
                    <a href="{{ route('2fa_verify_code') }}">Envoyez-moi un nouveau code</a>
                </div>
                @endif
            </div>
        </form>
</x-guest-layout>