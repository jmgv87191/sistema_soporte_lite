<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registrar cualquier servicio de autenticación / autorización.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('is-user', function ($user) {
            return $user->role === 'user';
        });
    }
}
