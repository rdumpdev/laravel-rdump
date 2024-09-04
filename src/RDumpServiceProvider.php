<?php

namespace RDumpDev\RDump;

use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Support\ServiceProvider;


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
    }
}
