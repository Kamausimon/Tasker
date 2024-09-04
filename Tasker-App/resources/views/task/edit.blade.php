@extends('task.index')

@section('content')

<div class="max-w-2xl mx-auto p-8 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Edit Task</h2>

    <form action="{{ route('task.update', $task->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Title Input -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
        </div>

        <!-- Description Input -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea id="description" name="description" rows="4"
                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                             focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                             dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>{{ old('description', $task->description) }}</textarea>
        </div>

        <!-- Completed Toggle -->
        <div class="flex items-center">
            <label for="toggleFour" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mr-3">Completed</label>
            <label class="relative inline-flex items-center cursor-pointer select-none">
                <input type="checkbox" id="toggleFour" name="completed"
                    class="sr-only peer" {{ old('completed', $task->completed) ? 'checked' : '' }}>
                <div class="block bg-gray-200 dark:bg-dark-2 w-14 h-8 rounded-full peer-checked:bg-blue-600"></div>
                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition peer-checked:translate-x-full"></div>
            </label>
        </div>

        <!-- Completed At Input -->
        <div>
            <label for="completed_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completed At</label>
            <input type="datetime-local" name="completed_at" id="completed_at"
                value="{{ old('completed_at', $task->completed_at ? date('Y-m-d', strtotime($task->completed_at)) : '') }}"
                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        </div>

        <!-- Due At Input -->
        <div>
            <label for="due_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due At</label>
            <input type="date" name="due_at" id="due_at"
                value="{{ old('due_at', $task->due_at ? date('Y-m-d', strtotime($task->due_at)) : '') }}"
                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        </div>

        <!-- Priority Selector -->
        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
            <select id="priority" name="priority"
                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between">
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md shadow-md
                           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">Update Task</button>
            <button type="reset"
                class="w-full py-2 px-4 ml-4 bg-gray-500 text-white font-semibold rounded-md shadow-md
                           hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75">Discard Changes</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('toggleFour');
        const completedAtInput = document.getElementById('completed_at');

        toggle.addEventListener('change', function() {
            if (toggle.checked) {
                const now = new Date().toISOString().slice(0, 16);
                completedAtInput.value = now;
            } else {
                completedAtInput.value = '';
            }
        });
    });
</script>

@endsection
