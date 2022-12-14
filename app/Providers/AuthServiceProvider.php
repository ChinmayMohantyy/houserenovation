<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('haveAdminAccess', function ($admin) {
            // $admin = Auth::guard('admin')->user();
            return $admin->role == 'admin';
        });

        Gate::define('haveFieldAssistantAccess', function (Admin $admin) {
            return $admin->role == 'field_assistant';
        });
    }
}
