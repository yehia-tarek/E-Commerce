<?php

namespace App\Providers;

use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Services\Role\IRoleService;
use App\Services\User\IUserService;
use App\Services\Admin\AdminService;
use App\Services\Admin\IAdminService;
use Illuminate\Support\ServiceProvider;
use App\Services\Category\CategoryService;
use App\Services\Category\ICategoryService;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind(IAdminService::class, AdminService::class);
        $this->app->bind(IRoleService::class, RoleService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
    }
}
