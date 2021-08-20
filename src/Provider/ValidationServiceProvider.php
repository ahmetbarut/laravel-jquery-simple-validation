<?php

namespace ahmetbarut\Validation\Provider;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('form', function () {
            return new \ahmetbarut\Validation\Form;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . "/../../public" => public_path('laravel-validation')
        ]);
    }
}
