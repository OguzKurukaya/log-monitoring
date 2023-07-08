<?php

namespace Oguzkurukaya\LogMonitoring;

use Illuminate\Support\ServiceProvider;
use Oguzkurukaya\LogMonitoring\Services\LogManager;

class LogMonitorProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->register(LogMonitoringRouteProvider::class);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../views', 'log-monitoring');

    }

    public function register()
    {

        $this->app->bind('LogManager', function () {
            return new LogManager();
        });

    }
}


