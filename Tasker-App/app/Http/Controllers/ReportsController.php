<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class ReportsController extends Controller
{
    //
    public function summaryReport()
    {
        $completedTasks = Task::where('completed', true)->get();
        $countCompletedTasks = Task::where('completed', true)->count();
        $totalTasks = Task::count();

        $completionRate = $totalTasks > 0 ? ($countCompletedTasks / $totalTasks) * 100 : 0;
        $tasksByUser = Task::select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get();

        // Fetch projects data
        $projects = Project::withCount('tasks')->get();
        $overdueProjects = Project::where('end_date', '<', now())->get();

        // Pass data to the view
        return view('reports.summary', compact('completedTasks', 'tasksByUser', 'projects', 'overdueProjects', 'completionRate'));
    }

    public function taskReport()
    {
        //get all tasks
        $completedTasks = Task::where('status', 'completed')->get();

        //group tasks by user
        $tasksByUser = Task::select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')->get();

        return view('reports.tasks', compact('completedTasks', 'tasksByUser'));
    }

    public function projectReport()
    {
        // Example: Get all projects with their task counts
        $projects = Project::withCount('tasks')->get();

        // Example: Get overdue projects
        $overdueProjects = Project::where('deadline', '<', now())->get();

        // Return the report data to a view
        return view('reports.projects', compact('projects', 'overdueProjects'));
    }
}
