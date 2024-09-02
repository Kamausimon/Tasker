<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class sidebarViewServiceProvider extends ServiceProvider
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
        //
        View::composer('partials._sidebar', function ($view) {
            $recentProject = Project::latest()->first();

            if ($recentProject) {
                // Log specific details of the recent project
                Log::info('Retrieved recent project', [
                    'id' => $recentProject->id,
                    'name' => $recentProject->name,
                    'created_at' => $recentProject->created_at,
                ]);
            } else {
                // Log that no recent project was found
                Log::info('No recent project found');
            }
            $view->with('recentProject', $recentProject);
        });
    }
}
