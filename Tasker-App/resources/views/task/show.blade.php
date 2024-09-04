@extends('task.index')

@section('content')

<div class="max-w-2xl mx-auto p-8 bg-white rounded-lg shadow-lg dark:bg-gray-900 mt-6">
    <h2 class="text-3xl font-extrabold text-gray-800 dark:text-white mb-6">Task Details</h2>

    <!-- Title Section -->
    <div class="mb-5">
        <label class="block text-sm font-semibold text-gray-500 dark:text-gray-400">Title</label>
        <p class="mt-2 text-xl text-gray-900 dark:text-white">{{ $task->title }}</p>
    </div>

    <!-- Description Section -->
    <div class="mb-5">
        <label class="block text-sm font-semibold text-gray-500 dark:text-gray-400">Description</label>
        <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $task->description }}</p>
    </div>

    <!-- Completed Section -->
    <div class="mb-5">
        <label class="block text-sm font-semibold text-gray-500 dark:text-gray-400">Completed</label>
        <p class="mt-2 text-lg">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                   {{ $task->completed ? 'bg-green-100 text-green-800 dark:bg-green-200' : 'bg-red-100 text-red-800 dark:bg-red-200' }}">
                {{ $task->completed ? 'Yes' : 'No' }}
            </span>
        </p>
    </div>

    <!-- Completed At Section -->
    <div class="mb-5">
        <label class="block text-sm font-semibold text-gray-500 dark:text-gray-400">Completed At</label>
        <p class="mt-2 text-lg text-gray-900 dark:text-white">
            {{ $task->completed_at ? date('Y-m-d', strtotime($task->due_at)) : 'N/A'}}
        </p>
    </div>

    <!-- Due At Section -->
    <div class="mb-5">
        <label class="block text-sm font-semibold text-gray-500 dark:text-gray-400">Due At</label>
        <p class="mt-2 text-lg text-gray-900 dark:text-white">
            {{ $task->due_at ? date('Y-m-d', strtotime($task->due_at)) : 'N/A' }}
        </p>
    </div>

    <!-- Priority Section -->
    <div class="mb-5">
        <label class="block text-sm font-semibold text-gray-500 dark:text-gray-400">Priority</label>
        <p class="mt-2 text-lg">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                   {{ $task->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-200' : ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-200' : 'bg-green-100 text-green-800 dark:bg-green-200') }}">
                {{ ucfirst($task->priority) }}
            </span>
        </p>
    </div>

    <!-- Edit Button -->
    <div class="flex justify-end">
        <a href="{{ route('task.edit', $task->id) }}"
            class="py-2 px-6 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700
                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition ease-in-out duration-150">
            Edit Task
        </a>
    </div>
</div>

@endsection
