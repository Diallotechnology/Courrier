<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Annotation;
use App\Models\Imputation;
use App\Models\User;
use App\Policies\AnnotationPolicy;
use App\Policies\ImputationPolicy;
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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
