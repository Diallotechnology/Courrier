<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LicenceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $structure = $request->user()->user_structure();

        if (!$structure) {
            // Gérer le cas où la structure n'est pas associée à une licence valide
            return redirect()->route('licence_expire');
        }

        $license = $structure->licence;

        if (!$license->active || ($license->isTrialVersion() && !$license->isExpired())) {
            // Gérer le cas où la licence est inactive ou en version d'essai expirée
            return redirect()->route('licence_expire');
        }

        if (!$license || !$license->active || $license->date_expiration < now()) {
            // Gérer le cas où la licence est invalide ou expirée
            return redirect()->route('licence_expire');
        }
        return $next($request);
    }
}
