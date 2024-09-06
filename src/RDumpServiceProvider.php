<?php

namespace RDumpDev\RDump;

use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Support\ServiceProvider;
use RDumpDev\RDump\Middleware\ErrorReportingMiddleware;


class RDumpServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/rdump.php', 'rdump'
        );
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/rdump.php' => config_path('rdump.php'),
            ], 'config');
        }

        if (config('rdump.error_reporting_enabled') === true) {
            foreach (config('rdump.error_reporting_groups') as $group) {
                $this->app['router']->middleware('error-reporting', ErrorReportingMiddleware::class);
                $this->app['router']->pushMiddlewareToGroup($group, ErrorReportingMiddleware::class);
            }
        }
    }
}
