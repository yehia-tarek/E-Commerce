<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\IRoleRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\IAdminRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\ICategoryRepository;

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
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
    }
}
