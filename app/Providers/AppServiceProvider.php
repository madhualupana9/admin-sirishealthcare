<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        // Force HTTPS in production
        if (app()->environment('production')) {
        URL::forceScheme('https');
        }

        // Set the asset URL to include /admins prefix
        if ($assetUrl = config('app.asset_url')) {
            URL::forceRootUrl($assetUrl);
        }

        // Configure Livewire for subdirectory
        Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle)
            ->middleware('web');
        });

          // Livewire script route WITH web middleware
            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/livewire/livewire.js', $handle)
                    ->middleware('web');
            });

        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });
    }
}