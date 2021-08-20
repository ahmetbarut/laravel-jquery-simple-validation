<?php

namespace ahmetbarut\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('form', function () {
            return new \ahmetbarut\Validation\Facades\Form;
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
            __DIR__ . "../main.js" => public_path('laravel-jq-validation.js')
        ]);
    }
}
