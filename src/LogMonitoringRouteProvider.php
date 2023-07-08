<?php

namespace Oguzkurukaya\LogMonitoring;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class LogMonitoringRouteProvider extends ServiceProvider
{

    public function boot()
    {
        $this->routes(
            function () {
                $route = Route::prefix('log_monitoring');

                if (
                    config('logging.log_monitoring.middleware') &&
                    config('logging.log_monitoring.middleware') != '') {
                    $route->middleware(config('logging.log_monitoring.middleware'));

                }
                $route->group(__DIR__ . '/routes.php');

            });
        $this->loadRoutes();
    }

    public function register()
    {

    }
}
