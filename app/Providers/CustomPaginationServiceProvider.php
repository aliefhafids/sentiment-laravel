<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CustomPaginationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the custom pagination view
        Paginator::defaultView('dashboard.layouts::custom');
        Paginator::defaultSimpleView('dashboard.layouts::simple-custom');
    }

    public function register()
    {
        //
    }
}
