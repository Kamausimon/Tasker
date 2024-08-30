@extends('task.index')

@section('content')
<div class="container mx-auto p-6">
    <!-- Heading and Counters -->
    <div class="mb-6">
        <h3 class="text-xl font-bold mb-4">
            Welcome, {{ $user->email }}
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Tasks In Progress Counter -->
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-bold mb-2">Tasks In Progress</h2>
                <p class="text-4xl font-semibold">{{ $tasksInProgressCount }}</p>
            </div>

            <!-- Finished Tasks Counter -->
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-bold mb-2">Finished Tasks</h2>
                <p class="text-4xl font-semibold">{{ $finishedTasksCount }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Tasks Created Card -->
        <div class="bg-white p-10 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Tasks Created</h2>
            <ul class="text-lg">
                @foreach($tasksCreated as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Tasks Due Today Card -->
        <div class="bg-white p-10 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Tasks Due Today</h2>
            <ul class="text-lg">
                @foreach($tasksDueToday as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Overdue Items Card -->
        <div class="bg-white p-10 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Overdue Items</h2>
            <ul class="text-lg">
                @foreach($overdueItems as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>


        <!-- Pending Tasks  Card -->
        <div class="bg-white p-10 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Pending Tasks</h2>
            <ul class="text-lg">
                @foreach($pendingTasks as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Projects Card -->
        <div class="bg-white p-10 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Projects</h2>
            <ul class="text-lg">
                @foreach($projects as $project)
                <li class="mb-2">{{ $project->name }}</li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection
