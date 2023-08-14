<x-guest-layout>
    <div class="container container-tight">
        <div class="text-center mb-4">
            <x-logo />
        </div>
        <form class="card card-md needs-validation" action="{{ route('change_password') }}" method="post"
            autocomplete="off" novalidate>
            @error('email')
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
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="col-12">
                    <div class="card-body">
                        <h3 class=" text-center mb-4">Changement de Mot de Passe Requis</h3>
                        <p>
                            Lors de votre première connexion, veuillez changer votre mot de passe pour des raisons de
                            sécurité. Suivez les critères ci-dessus et soumettez le formulaire. Votre compte sera
                            accessible avec le nouveau mot de passe.
                        </p>
                        <h4>
                            NB: Utilisez au moins huit (8) caractères, mélangez majuscules, minuscules, chiffres et
                            caractères spéciaux.
                        </h4>
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" autocomplete="new-password" required
                                class="form-control" placeholder="Entrez votre mot de passe">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmé le mot de passe</label>
                            <input type="password" name="password_confirmation" autocomplete="new-password" required
                                class="form-control" placeholder="Confirmé le mot de passe">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback">Ce champ est obligatoire.</div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Valider</button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>