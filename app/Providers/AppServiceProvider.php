<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function () {
            return auth()->check() && auth()->user()->role === 'administrador';
        });
        Gate::define('isOperator', function () {
            return auth()->check() && auth()->user()->role === 'operador';
        });
        Gate::define('isSuperUser', function () {
            return auth()->check() && auth()->user()->role === 'superusuario';
        });

    }
}
