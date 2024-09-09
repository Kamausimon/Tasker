@extends('task.index')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Summary Report</h1>

    <!-- Completion Rate -->
    <div class="mb-8 p-4 border rounded-lg bg-blue-100 dark:bg-blue-900">
        <h2 class="text-xl font-semibold text-blue-700 dark:text-blue-300 mb-2">Completion Rate</h2>
        <p class="text-3xl font-bold text-blue-800 dark:text-blue-400">{{ $completionRate }}%</p>
    </div>

    <!-- Completed Tasks -->
    <div class="mb-8 p-4 border rounded-lg bg-green-100 dark:bg-green-900">
        <h2 class="text-xl font-semibold text-green-700 dark:text-green-300 mb-2">Completed Tasks</h2>
        <ul class="list-disc pl-6 space-y-1 text-gray-700 dark:text-gray-300">
            @foreach($completedTasks as $task)
            <li>
                <span class="font-medium">{{ $task->title }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">(Completed by: {{ $task->user->email}})</span>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Tasks by User -->
    <div class="mb-8 p-4 border rounded-lg bg-yellow-100 dark:bg-yellow-900">
        <h2 class="text-xl font-semibold text-yellow-700 dark:text-yellow-300 mb-2">Tasks by User</h2>
        <ul class="list-none pl-0 space-y-1 text-gray-700 dark:text-gray-300">
            @foreach($tasksByUser as $task)
            <li class="flex justify-between items-center">
                <span class="font-medium">User ID: {{ $task->user_id }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">Total Tasks: {{ $task->total }}</span>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Projects -->
    <div class="mb-8 p-4 border rounded-lg bg-purple-100 dark:bg-purple-900">
        <h2 class="text-xl font-semibold text-purple-700 dark:text-purple-300 mb-2">Projects</h2>
        <ul class="list-none pl-0 space-y-1 text-gray-700 dark:text-gray-300">
            @foreach($projects as $project)
            <li class="flex justify-between items-center">
                <span class="font-medium">{{ $project->name }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">Total Tasks: {{ $project->tasks_count }}</span>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Overdue Projects -->
    <div class="mb-8 p-4 border rounded-lg bg-red-100 dark:bg-red-900">
        <h2 class="text-xl font-semibold text-red-700 dark:text-red-300 mb-2">Overdue Projects</h2>
        <ul class="list-none pl-0 space-y-1 text-gray-700 dark:text-gray-300">
            @foreach($overdueProjects as $project)
            <li class="flex justify-between items-center">
                <span class="font-medium">{{ $project->name }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">(End Date: {{ $project->end_date->format('Y-m-d') }})</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
