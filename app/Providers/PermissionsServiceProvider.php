<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class PermissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        // Only register permissions if the permissions table exists
        if (\Schema::hasTable('permissions')) {
            try {
                Permission::get()->each(function ($permission) {
                    Gate::define($permission->slug, function (User $user) use ($permission) {
                        return $user->hasPermission($permission->slug);
                    });
                });
            } catch (\Exception $e) {
                \Log::error('Permission registration failed: '.$e->getMessage());
            }
        }
    }
}
