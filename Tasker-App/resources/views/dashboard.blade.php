@extends('task.index')

@section('content')
<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Tasks Created Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Tasks Created</h2>
            <ul>
                @foreach($tasksCreated as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Tasks Due Today Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Tasks Due Today</h2>
            <ul>
                @foreach($tasksDueToday as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Overdue Items Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Overdue Items</h2>
            <ul>
                @foreach($overdueItems as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Pending Tasks Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Pending Tasks</h2>
            <ul>
                @foreach($pendingTasks as $task)
                <li class="mb-2">{{ $task->title }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Projects Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Projects</h2>
            <ul>
                @foreach($projects as $project)
                <li class="mb-2">{{ $project->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection