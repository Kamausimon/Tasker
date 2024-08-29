<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use App\Models\Task;
use App\Models\Project;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //fetch data from the db 


        //share that data with the dashboard
        Facades\View::composer('dashboard', function ($view) {});
    }
}
