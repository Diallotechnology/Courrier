<?php

namespace App\Http\Middleware;

use Closure;
use App\Enum\RoleEnum;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // Vérifie si l'utilisateur a l'un des rôles spécifiés
        $hasAccess = false;
        foreach ($roles as $role) {
            if ($user && $user->role === $role) {
                $hasAccess = true;
                break;
            }
        }

        // Si l'utilisateur a l'un des rôles spécifiés ou un rôle supérieur, autoriser l'accès
        if ($hasAccess || $this->hasHigherRole($user, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

    private function hasHigherRole($user, $roles)
    {
        $rolePriorities = [
            RoleEnum::SUPERADMIN => 5,
            RoleEnum::ADMIN => 4,
            RoleEnum::USER => 3,
            RoleEnum::SUPERUSER => 2,
            RoleEnum::SECRETAIRE => 1,
            RoleEnum::AGENT => 0,
        ];

        $userPriority = $rolePriorities[$user->role] ?? 0;

        foreach ($roles as $role) {
            if ($rolePriorities[$role] > $userPriority) {
                return true;
            }
        }

        return false;
    }
}
