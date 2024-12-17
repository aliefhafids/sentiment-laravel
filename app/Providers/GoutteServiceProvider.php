<?php

namespace App\Providers;

use Goutte\Client;
use Illuminate\Support\ServiceProvider;

class GoutteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            return new Client();
        });
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
