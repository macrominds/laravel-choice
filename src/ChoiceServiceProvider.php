<?php

namespace macrominds\laravel\choice;

use Illuminate\Support\ServiceProvider;

class ChoiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'choice');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/choice'),
                __DIR__.'/../resources/assets/sass' => resource_path('assets/sass/vendor/choice'),
            ], 'laravel-choice');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
