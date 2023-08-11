<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        $user = $request->user();
        $structure = $user->user_structure();

        if (! $user->isSuperadmin() && (! $structure || ! $structure->expire_at || $structure->isExpired())) {
            if (! $user->isAdmin()) {
                Auth::logout();
            }

            return response(View::make('licence_expire', ['message' => 'Votre licence a expiré !']), 403);
        }

        return $next($request);
    }
}
