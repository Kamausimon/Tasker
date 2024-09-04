@extends('task.index')

@section('content')
<div class="container mx-auto p-6">
    <!-- Heading and Counters -->
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
            Welcome, {{ $user->email }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Tasks In Progress Counter -->
            <div class="bg-blue-100 dark:bg-blue-800 p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-bold text-blue-800 dark:text-blue-200 mb-2">Tasks In Progress</h2>
                <p class="text-4xl font-semibold text-blue-900 dark:text-blue-300">{{ $tasksInProgressCount }}</p>
            </div>

            <!-- Finished Tasks Counter -->
            <div class="bg-green-100 dark:bg-green-800 p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-bold text-green-800 dark:text-green-200 mb-2">Finished Tasks</h2>
                <p class="text-4xl font-semibold text-green-900 dark:text-green-300">{{ $finishedTasksCount }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Tasks Created Card -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Tasks Created</h2>
            <ul class="text-lg text-gray-600 dark:text-gray-300 space-y-2">
                @foreach($tasksCreated as $task)
                <li class="hover:text-blue-500 dark:hover:text-blue-400">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Tasks Due Today Card -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Tasks Due Today</h2>
            <ul class="text-lg text-gray-600 dark:text-gray-300 space-y-2">
                @foreach($tasksDueToday as $task)
                <li class="hover:text-blue-500 dark:hover:text-blue-400">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Overdue Items Card -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-red-600 dark:text-red-400 mb-4">Overdue Items</h2>
            <ul class="text-lg text-gray-600 dark:text-gray-300 space-y-2">
                @foreach($overdueItems as $task)
                <li class="hover:text-red-500 dark:hover:text-red-400">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Pending Tasks Card -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mb-4">Pending Tasks</h2>
            <ul class="text-lg text-gray-600 dark:text-gray-300 space-y-2">
                @foreach($pendingTasks as $task)
                <li class="hover:text-yellow-500 dark:hover:text-yellow-400">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Projects Card -->
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Projects</h2>
            <ul class="text-lg text-gray-600 dark:text-gray-300 space-y-2">
                @foreach($projects as $project)
                <li class="hover:text-green-500 dark:hover:text-green-400">{{ $project->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
