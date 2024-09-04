@extends('task.index')

@section('content')

<div class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow-lg mt-12 dark:bg-gray-900">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Create New Task</h2>

    <form action="{{ route('task.store') }}" method="POST" id="taskForm" class="space-y-6">
        @csrf

        <!-- Title Input -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
            @error('title')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description Input -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea id="description" name="description" rows="3"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                             focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                             dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>{{ old('description') }}</textarea>
            @error('description')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Due Date Input -->
        <div>
            <label for="due_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due At</label>
            <input type="date" id="due_at" name="due_at" value="{{ old('due_at') }}"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                min="{{ now()->format('Y-m-d') }}" required>
            @error('due_at')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Priority Selector -->
        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
            <select id="priority" name="priority"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit"
                class="py-2 px-6 bg-blue-600 text-white font-semibold rounded-md shadow-md
                           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75
                           transition ease-in-out duration-150">
                Create Task
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dueDateInput = document.getElementById('due_at');
        const today = new Date().toISOString().split('T')[0];
        dueDateInput.setAttribute('min', today);

        dueDateInput.addEventListener('change', function() {
            if (new Date(dueDateInput.value) < new Date(today)) {
                alert('The due date cannot be in the past.');
                dueDateInput.value = today;
            }
        });
    });
</script>

@endsection
