<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use App\Models\Task;

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
            // Retrieve the most recently created project
            $recentProject = Project::latest()->first();

            // Retrieve the most recently created incomplete tasks
            $recentIncompleteTasks = Task::where('completed', false)
                ->latest() // Order by 'created_at' in descending order
                ->take(3)  // Limit to 3 tasks, adjust as needed
                ->get();

            // Log details of the recent project if found




            // Share both the recent project and recent incomplete tasks with the view
            $view->with([
                'recentProject' => $recentProject,
                'recentIncompleteTasks' => $recentIncompleteTasks,
            ]);
        });
    }
}
