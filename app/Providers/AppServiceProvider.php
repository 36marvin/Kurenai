<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Throws an error when an Eloquent model rejects an attribute
        // because it was not fillable. Does not work in production. 
        // Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
    }
}
