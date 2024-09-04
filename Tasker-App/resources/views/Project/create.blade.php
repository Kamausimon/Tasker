@extends('task.index')

@section('content')

<div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-8 dark:bg-gray-900">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Create New Project</h2>

    <form action="{{ route('project.store') }}" method="POST" id="projectForm" class="space-y-6">
        @csrf

        <!-- Owner Input -->
        <div>
            <label for="owner" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Owner</label>
            <input type="text" name="owner" id="owner" value="{{ Auth::user()->email }}"
                class="mt-2 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white" readonly>
        </div>

        <!-- Project Name Input -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Project Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            @error('name')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description Input -->
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" id="description" rows="4"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                             focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                             dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>{{ old('description') }}</textarea>
            @error('description')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Start Date Input -->
        <div>
            <label for="start_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Start Date</label>
            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white" min="{{ now()->format('Y-m-d') }}" required>
            @error('start_date')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- End Date Input -->
        <div>
            <label for="end_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">End Date</label>
            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white" min="{{ now()->format('Y-m-d') }}" required>
            @error('end_date')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tags Input -->
        <div>
            <label for="tags" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tags</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                          focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('tags')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Priority Selector -->
        <div>
            <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Priority</label>
            <select id="priority" name="priority"
                class="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tasks Section -->
        <div id="tasks-container" class="space-y-4">
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tasks</label>
            <div class="task p-4 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-md space-y-2">
                <input type="text" name="tasks[0][title]" placeholder="Task Title"
                    class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                              focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                              dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <textarea name="tasks[0][description]" placeholder="Task Description" rows="2"
                    class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                                 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                                 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
                <input type="date" name="tasks[0][due_at]"
                    class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                              focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                              dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <select name="tasks[0][priority]"
                    class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                               dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>

        <!-- Add Task Button -->
        <button type="button" onclick="addTask()"
            class="mt-4 w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md shadow-md
                       hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75
                       transition ease-in-out duration-150">
            Add Task
        </button>

        <!-- Submit Button -->
        <div class="flex justify-end mt-6">
            <button type="submit"
                class="py-2 px-6 bg-green-600 text-white font-semibold rounded-md shadow-md
                           hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75
                           transition ease-in-out duration-150">
                Create Project
            </button>
        </div>
    </form>
</div>

<script>
    let taskIndex = 1;

    function addTask() {
        const container = document.getElementById('tasks-container');
        const taskDiv = document.createElement('div');
        taskDiv.classList.add('task', 'p-4', 'bg-gray-50', 'dark:bg-gray-800', 'rounded-lg', 'shadow-md', 'space-y-2');
        taskDiv.innerHTML = `
            <input type="text" name="tasks[${taskIndex}][title]" placeholder="Task Title" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            <textarea name="tasks[${taskIndex}][description]" placeholder="Task Description" rows="2" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
            <input type="date" name="tasks[${taskIndex}][due_at]" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            <select name="tasks[${taskIndex}][priority]" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        `;
        container.appendChild(taskDiv);
        taskIndex++;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const today = new Date().toISOString().split('T')[0];
        startDateInput.setAttribute('min', today);

        startDateInput.addEventListener('change', function() {
            if (new Date(startDateInput.value) < new Date(today)) {
                alert('The start date cannot be in the past.');
                startDateInput.value = today;
            }
        });
    });
</script>

@endsection
