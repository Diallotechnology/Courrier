<?php

namespace App\Http\Controllers\Auth;

use App\Helper\DeleteAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerificationCodeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use DeleteAction;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function form_2fa(): View
    {
        return view('auth.2fa');
    }

    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|min:6',
        ]);

        $userId = session('two_factor:user_id');
        if (is_null($userId)) {
            return redirect()->route('login');
        }
        $user = User::findOrFail($userId);

        if ($request->code == $user->two_factor_code) {
            Auth::login($user);
            $user->two_factor_code = null;
            $user->save();
            session()->forget('two_factor:user_id');

            return redirect()->intended(RouteServiceProvider::HOME);
        } else {

            throw ValidationException::withMessages([
                'code' => 'Le code de vérification est incorrect.',
            ]);
        }
    }

    public function SendVerificationCode()
    {
        $userId = session('two_factor:user_id');
        $user = User::findOrFail($userId);
        $verificationCode = '';
        $length = 6;

        for ($i = 0; $i < $length; $i++) {
            $verificationCode .= mt_rand(0, 9);
        }

        $user->two_factor_code = $verificationCode;
        $user->save();
        // Envoyez l'e-mail contenant le code de vérification
        Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

        return to_route('2fa_verify.form')->with('success', 'Le code de vérification a été envoyé à votre adresse e-mail.');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = User::where('email', $request->email)->first();

        if ($user && $user->two_factor_enabled == true) {
            Auth::logout();
            session()->put('two_factor:user_id', $user->id);
            $verificationCode = '';
            $length = 6;

            for ($i = 0; $i < $length; $i++) {
                $verificationCode .= mt_rand(0, 9);
            }
            $user->two_factor_code = $verificationCode;
            $user->save();
            // Envoyez l'e-mail contenant le code de vérification
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            return redirect()->intended(RouteServiceProvider::DFA)->with('success', 'Le code de vérification a été envoyé à votre adresse e-mail.');
        } else {
            $request->session()->regenerate();
            $this->journal('Connexion');

            return redirect()->intended(RouteServiceProvider::HOME);
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->journal('Deconnexion');
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login');
    }
}
