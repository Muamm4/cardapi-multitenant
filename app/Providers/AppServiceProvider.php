<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('currentTenant', function ($app) {
            return null;
        });
    }

    public function boot(): void
    {
        //
    }
}

