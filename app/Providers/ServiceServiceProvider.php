<?php

namespace App\Providers;

use App\Services\Admin\AdminService;
use App\Services\Admin\IAdminService;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(IAdminService::class, AdminService::class, );
    }
}
