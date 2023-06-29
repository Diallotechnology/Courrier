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
        if (!$request->user()->isSuperadmin() && $structure->licence && $structure->licence->isExpired()) {
            $structure->licence->active == true ? $structure->licence->updateOrFail(['active' => 0]) : '';
            // Gérer le cas où la structure n'est pas associée à une licence valide
            return abort(403);
            // return to_route('licence_expire');
        }
        return $next($request);
    }
}
