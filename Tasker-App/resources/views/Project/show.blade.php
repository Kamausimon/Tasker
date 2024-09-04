@extends('task.index')

@section('content')

<div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Project Details</h2>

    <!-- Project Basic Information -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->name }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->description }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->start_date->format('Y-m-d') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->end_date->format('Y-m-d') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Owner</label>
            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ Auth::user()->email }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ ucfirst($project->priority) }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completed</label>
            <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->completed ? 'Yes' : 'No' }}</p>
        </div>
    </div>

    <!-- Collaborators Section -->
    <div class="mb-6">
        <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">Collaborators</label>
        @if ($project->collaborators && $project->collaborators->isNotEmpty())
        <ul class="list-disc list-inside bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
            @foreach ($project->collaborators as $collaborator)
            <li class="text-gray-900 dark:text-gray-100">{{ $collaborator->email }}</li>
            @endforeach
        </ul>
        @else
        <p class="text-gray-700 dark:text-gray-300"><a href="{{ route('project.edit', $project->id) }}" class="text-blue-500 hover:underline">Add Collaborators</a></p>
        @endif
    </div>

    <!-- Tasks Section -->
    <div class="mb-6">
        <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">Tasks</label>
        @if (!empty($project->tasks)) <!-- Check if the tasks array is not empty -->
        <ul class="space-y-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
            @foreach ($project->tasks as $task)
            <li class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $task['title'] }}</h3>
                <p class="text-gray-600 dark:text-gray-400">Due: {{ $task['due_at'] ? date('Y-m-d', strtotime($task['due_at'])) : 'No due date' }}</p>
                <p class="text-gray-700 dark:text-gray-300">Description: {{ $task['description'] }}</p>
                <p class="text-gray-700 dark:text-gray-300">Priority: <span class="font-semibold">{{ ucfirst($task['priority']) }}</span></p>
            </li>
            @endforeach
        </ul>
        @else
        <p class="text-gray-700 dark:text-gray-300">No tasks added yet.</p>
        @endif
    </div>

    <!-- Edit Project Button -->
    <div class="flex justify-end">
        <a href="{{ route('project.edit', $project->id) }}" class="py-2 px-6 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">Edit Project</a>
    </div>
</div>

@endsection
