<?php

namespace Hosein\Uploader;

use Illuminate\Support\ServiceProvider;

class UploaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'UploaderView');
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/UploaderView'),
        ],"uploaderview");
        $this->publishes([
            __DIR__.'/Migrations' => database_path('/migrations')
        ], 'uploadermigrations');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
}
