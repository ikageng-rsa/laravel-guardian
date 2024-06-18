<?php

namespace Qanna\Guardian;

use Illuminate\Support\ServiceProvider;

class GuardianServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole()){
            $this->registerPublishing();
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-password-monitor');

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/guardian.php', 'guardian'
        );
    }

    private function registerPublishing()
    {
        $this->publishes([
            __DIR__."/../config/guardian.php" => config_path('guardian.php'),
        ], 'password-monitor-config');   
    }
}