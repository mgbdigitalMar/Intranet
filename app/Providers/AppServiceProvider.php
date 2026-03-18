<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Optimize queries globally
        \Illuminate\Database\Eloquent\Model::preventLazyLoading(!app()->isProduction());

        // Cache frequently used data (skip if Redis not ready)
        if (app()->isProduction() && class_exists('Redis')) {
            try {
                \Cache::rememberForever('app_stats', function () {
                    return [
                        'total_users' => \App\Models\User::count(),
                        'total_rooms' => \App\Models\CompanyRoom::count(),
                        'total_cars' => \App\Models\CompanyCar::count(),
                    ];
                });
            } catch (\Exception $e) {
                // Skip cache if Redis unavailable
            }
        }
    }
}
