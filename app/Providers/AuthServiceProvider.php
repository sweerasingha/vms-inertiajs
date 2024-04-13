<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()

    {
        $this->registerPolicies();

        Gate::define("all_permissions", function ($user) {
            return true;
        });

        Gate::define("create_unit_measurements", function ($user) {
            \Log::info('User:', ['id' => $user->id]); // Check if user ID is logged correctly
            return true;
        });


        Gate::define('read_categories', function ($user) {
            // Here you define who has the permission to 'read_categories'
            // return $user->is_admin || $user->hasRole('manager'); // Adjust according to your user attributes or roles
            return true; // For testing purposes
        });

        Gate::define('read_unit_measurements', function ($user) {
            return true;
        });

        Gate::define('add_permissions', function ($user) {
            return true;
        });
    }
}
