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

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-guardian');

    }

    public function register()
    {
        //
    }

    private function registerPublishing()
    {
        $this->publishes([
            __DIR__."/../config/guardian.php" => config_path('guardian.php'),
        ], 'guardian-config');   
    }
}