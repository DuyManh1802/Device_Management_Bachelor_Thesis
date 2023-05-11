<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            $User = $user->role == 1 || $user->role == 2;
            return $User
                        ? Response::allow()
                        : Response::deny('You must be a administrator.');
        });

        Gate::define('isSuperAdmin', function ($user) {
            return $user->role==2
                        ? Response::allow()
                        : Response::deny('You must be a super administrator.');
        });
    }
}
