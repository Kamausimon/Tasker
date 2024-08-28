<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::all();
        Log::info('tasks fetched');

        return view('dashboard', ['tasks' => $tasks]);
    }
}
