<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
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
        Gate::define('schedule-class', function (User $user) {
            return $user->role === 'instructor'
            ? Response::allow()
            : Response::deny('You are not authorized to schedule a class.');
        });
    {
        Gate::define('book-class', function (User $user) {
            return $user->role === 'member'
            ? Response::allow()
            : Response::deny('You are not authorized to schedule a class.');
        });
    }
}
}
