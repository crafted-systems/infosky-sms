<?php

namespace CraftedSystems\InfoSky;

use Illuminate\Support\ServiceProvider;

class InfoSkySMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/Config/infosky.php' => config_path('infosky.php'),
        ], 'infosky_config');

        $this->app->singleton(InfoSkySMS::class, function () {
            return new InfoSkySMS(config('infosky'));
        });

        $this->app->alias(InfoSkySMS::class, 'infosky-sms');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/infosky.php', 'infosky-sms'
        );
    }
}
