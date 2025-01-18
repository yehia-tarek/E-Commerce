<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\IAdminRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\IRoleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(IAdminRepository::class, AdminRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
    }
}
