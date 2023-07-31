<?php

namespace App\Providers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('edit-property', function (Agent $agent, Property $property) {
            return $agent->id === $property->agent_id;
        });
        
        Gate::define('delete-property', function (Agent $agent, Property $property) {
            return $agent->id === $property->agent_id;
        });

        Gate::define('set-property-status', function (Agent $agent, Property $property) {
            return $agent->id === $property->agent_id;
        });

        Gate::define('show-property', function (Agent $agent, Property $property) {
            return $agent->id === $property->agent_id;
        });

        $this->registerPolicies();

        //
    }
}
