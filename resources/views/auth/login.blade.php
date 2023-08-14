<x-guest-layout>
    <style>
        .loader {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg">
                <div class="container-tight">
                    <div class="text-center mb-4">
                        <a href="{{ route('login') }}" class="navbar-brand navbar-brand-autodark">
                            <x-logo />
                        </a>
                    </div>
                    <div class="card card-md">
                        <div class="card-body">
                            <h2 class="h2 text-center mb-4">Connexion</h2>
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <form autocomplete="off" novalidate method="POST" action="{{ route('login') }}"
                                id="loginForm">
                                @csrf
                                <div class="mb-3">
                                    <x-input type="email" name="email" place="your@email.com"
                                        :messages="$errors->get('email')" :value="old('email')" autofocus
                                        autocomplete="username" />
                                </div>
                                <div class="mb-2">
                                    @if (Route::has('password.request'))
                                    <label class="form-label">
                                        MOT DE PASSE
                                        <span class="form-label-description">
                                            <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                                        </span>
                                    </label>
                                    @endif
                                    <div class="input-group input-group-flat">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="Votre mot de passe" autocomplete="current-password">
                                        <span class="input-group-text">
                                            <a href="#" id="togglePassword" class="link-secondary"
                                                data-bs-toggle="tooltip" aria-label="Show password"
                                                data-bs-original-title="Show password">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                    <path
                                                        d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7">
                                                    </path>
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="remember_me" class="form-check">
                                        <input id="remember_me" name="remember" type="checkbox"
                                            class="form-check-input" />
                                        <span class="form-check-label">Se souvenir de moi?</span>
                                    </label>
                                </div>
                                <div class="form-footer">
                                    <button id="loginButton" type="submit"
                                        class="btn btn-primary w-100">Seconnecter</button>
                                    <div id="loader" class="loader" style="display: none;"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg d-none d-lg-block">
                <img src="{{ asset('/img/bg_login.svg') }}" class="d-block mx-auto" alt="mailbox">
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const loginButton = document.getElementById('loginButton');
    const loader = document.getElementById('loader');
    const loginForm = document.getElementById('loginForm');

        togglePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePassword.textContent = 'Caché';
            } else {
                passwordInput.type = 'password';
                togglePassword.textContent = 'Voir';
            }
        });

        loginForm.addEventListener('submit', function () {
        loader.style.display = 'block';
        loginButton.setAttribute('disabled', 'disabled');
    });
    </script>

</x-guest-layout>