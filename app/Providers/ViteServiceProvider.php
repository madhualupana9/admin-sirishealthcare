<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;

class ViteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Vite::useManifest(
            base_path('../public_html/admins/public/build/manifest.json')
        );
        Vite::useBuildDirectory('/public/build');
    }
}
