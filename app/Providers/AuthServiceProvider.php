<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Annotation;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Departement;
use App\Models\Imputation;
use App\Models\Interne;
use App\Models\Nature;
use App\Models\Rapport;
use App\Models\Reponse;
use App\Models\Structure;
use App\Models\SubDepartement;
use App\Models\Task;
use App\Models\User;
use App\Policies\AnnotationPolicy;
use App\Policies\CorrespondantPolicy;
use App\Policies\CourrierPolicy;
use App\Policies\DepartementPolicy;
use App\Policies\DepartPolicy;
use App\Policies\ImputationPolicy;
use App\Policies\InternePolicy;
use App\Policies\NaturePolicy;
use App\Policies\RapportPolicy;
use App\Policies\ReponsePolicy;
use App\Policies\StructurePolicy;
use App\Policies\SubDepartementPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Imputation::class => ImputationPolicy::class,
        Annotation::class => AnnotationPolicy::class,
        Courrier::class => CourrierPolicy::class,
        Departement::class => DepartementPolicy::class,
        SubDepartement::class => SubDepartementPolicy::class,
        Structure::class => StructurePolicy::class,
        Interne::class => InternePolicy::class,
        Task::class => TaskPolicy::class,
        Depart::class => DepartPolicy::class,
        Rapport::class => RapportPolicy::class,
        Nature::class => NaturePolicy::class,
        Correspondant::class => CorrespondantPolicy::class,
        Reponse::class => ReponsePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
