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
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user(); // Obtenez l'objet utilisateur à partir de la requête (assurez-vous d'avoir la fonctionnalité d'authentification configurée)

        // Vérifiez si l'utilisateur a le rôle requis
        if ($user && $this->hasRole($user, $role)) {
            return $next($request); // L'utilisateur a le rôle approprié, laissez-le accéder à la route suivante
        }

        // L'utilisateur n'a pas le rôle approprié, vous pouvez personnaliser la réponse d'erreur selon vos besoins
        return abort(403);
    }


    /**
     * Check if the user has the specified role.
     *
     * @param  \App\User  $user
     * @param  string  $role
     * @return bool
     */
    private function hasRole($user, string $role): bool
    {
        // Utilisez les fonctions de la classe User pour vérifier le rôle de l'utilisateur
        return  match ($role) {
            RoleEnum::SUPERADMIN->value => $user->isSuperadmin(),
            RoleEnum::ADMIN->value => $user->isAdmin() || $user->isSuperadmin(),
            RoleEnum::SUPERUSER->value => $user->isSuperuser() || $user->isAdmin() || $user->isSuperadmin(),
            RoleEnum::SECRETAIRE->value => $user->isSecretaire() || $user->isAdmin() || $user->isSuperuser() || $user->isSuperadmin(),
            RoleEnum::AGENT->value => $user->isAgent() || $user->isSecretaire() || $user->isAdmin() || $user->isSuperuser() || $user->isSuperadmin(),
            default => false, // Rôle non pris en charge
        };
    }



}
