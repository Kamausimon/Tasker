@extends('task.index')
@section('content')

<div class="max-w-2xl mt-3 mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Task Details</h2>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $task->title }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $task->description }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completed</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $task->completed ? 'Yes' : 'No' }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completed At</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $task->completed_at ? $task->completed_at->format('Y-m-d H:i') : 'N/A' }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due At</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $task->due_at }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ ucfirst($task->priority) }}</p>
    </div>

    <div class="flex justify-end">
        <a href="{{ route('task.edit', $task->id) }}" class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">Edit Task</a>
    </div>
</div>

@endsection
