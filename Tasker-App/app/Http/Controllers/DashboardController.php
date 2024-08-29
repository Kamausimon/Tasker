<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(string $id)
    {
        $user = Auth::user();
        $tasksCreated = Task::where('user_id', Auth::id())->get();
        $tasksDueToday = Task::where('due_at', today())->where('user_id', Auth::id())->get();
        $overdueItems = Task::where('due_at', '<', today())->where('completed', false)->where('user_id', Auth::id())->get();
        $pendingTasks = Task::where('completed', false)->where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->get();

        $tasksInProgressCount = Task::where('user_id', $id)->where('completed', false)->count();
        $finishedTasksCount = Task::where('user_id', $id)->where('completed', true)->count();

        return view('dashboard', compact('user', 'tasksCreated', 'tasksDueToday', 'overdueItems', 'pendingTasks', 'projects', 'tasksInProgressCount', 'finishedTasksCount'));
    }
}
