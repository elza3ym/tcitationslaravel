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
        //
        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            // Return the name of the policy class for the given model...
            if ($modelClass === \App\Models\Ticket::class) {
                return \App\Policies\Policies\TicketPolicy::class;
            } elseif ($modelClass === \App\Models\Company::class) {
                return \App\Policies\Policies\CompanyPolicy::class;
            } elseif ($modelClass === \App\Models\Driver::class) {
                return \App\Policies\Policies\DriverPolicy::class;
            }
        });

    }
}
