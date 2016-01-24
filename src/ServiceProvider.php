<?php

namespace TheRezor\CurrencyWidget;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config
        $this->publishes([
            __DIR__.'/config/currency-widget.php' => config_path('currency-widget.php'),
        ],'config');

        // publishing assets
        $this->publishes([
            __DIR__.'/assets' => public_path('widget'),
        ], 'assets');

        // publish view
        $this->publishes([
            __DIR__.'/views' => resource_path('views/widgets'),
        ], 'views');

        // add route
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        // set right namespace in laravel widgets config
        $this->mergeConfigFrom(
            __DIR__.'/config/laravel-widgets.php', 'laravel-widgets'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
