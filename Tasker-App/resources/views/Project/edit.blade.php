@extends('task.index')

@section('content')

<div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Edit Project</h2>

    <!-- Edit Form -->
    <form action="{{ route('project.update', $project->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Project Basic Information -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                <select name="priority" id="priority" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <option value="low" {{ old('priority', $project->priority) == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $project->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $project->priority) == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div>
                <label for="completed" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completed</label>
                <select name="completed" id="completed" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <option value="0" {{ old('completed', $project->completed) == false ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('completed', $project->completed) == true ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>

        <!-- Collaborators Section -->
        <div class="mb-6">
            <label for="collaborators" class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">Collaborators</label>
            <div id="collaborators-container">
                @if (collect($project->collaborators)->isNotEmpty())
                <input type="text" name="collaborators" id="collaborators"
                    value="{{ old('collaborators', implode(', ', collect($project->collaborators)->pluck('email')->toArray())) }}"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                  focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                @else
                <input type="text" name="collaborators" id="collaborators"
                    value="{{ old('collaborators') }}"
                    placeholder="Add collaborators by email"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm
                  focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                @endif
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Enter emails separated by commas.</p>
            </div>
        </div>


        <!-- Tasks Section -->
        <div class="mb-6">
            <label class="block text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">Tasks</label>
            <div id="tasks-container">
                @foreach ($project->tasks as $index => $task)
                <div class="p-4 mb-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
                    <label for="tasks[{{ $index }}][title]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Title</label>
                    <input type="text" name="tasks[{{ $index }}][title]" value="{{ old("tasks.{$index}.title", $task['title']) }}" class="mt-1 block w-full px-3 py-2 mb-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">

                    <label for="tasks[{{ $index }}][description]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Description</label>
                    <textarea name="tasks[{{ $index }}][description]" class="mt-1 block w-full px-3 py-2 mb-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ old("tasks.{$index}.description", $task['description']) }}</textarea>

                    <label for="tasks[{{ $index }}][due_at]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                    <input type="date" name="tasks[{{ $index }}][due_at]" value="{{ old("tasks.{$index}.due_at", date('Y-m-d', strtotime($task['due_at']))) }}" class="mt-1 block w-full px-3 py-2 mb-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">

                    <label for="tasks[{{ $index }}][priority]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                    <select name="tasks[{{ $index }}][priority]" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="low" {{ old("tasks.{$index}.priority", $task['priority']) == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old("tasks.{$index}.priority", $task['priority']) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old("tasks.{$index}.priority", $task['priority']) == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addTask()" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add Task</button>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="py-2 px-6 bg-green-500 text-white font-semibold rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75">Update Project</button>
        </div>
    </form>
</div>

<script>
    // JavaScript to dynamically add new tasks to the form
    let taskIndex = count($project.tasks);

    function addTask() {
        const container = document.getElementById('tasks-container');
        const taskDiv = document.createElement('div');
        taskDiv.classList.add('p-4', 'mb-4', 'bg-gray-100', 'dark:bg-gray-700', 'rounded-lg', 'shadow-md');
        taskDiv.innerHTML = `
            <label for="tasks[${taskIndex}][title]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Title</label>
            <input type="text" name="tasks[${taskIndex}][title]" class="mt-1 block w-full px-3 py-2 mb-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">

            <label for="tasks[${taskIndex}][description]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Description</label>
            <textarea name="tasks[${taskIndex}][description]" class="mt-1 block w-full px-3 py-2 mb-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>

            <label for="tasks[${taskIndex}][due_at]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
            <input type="date" name="tasks[${taskIndex}][due_at]" class="mt-1 block w-full px-3 py-2 mb-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">

            <label for="tasks[${taskIndex}][priority]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
            <select name="tasks[${taskIndex}][priority]" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        `;
        container.appendChild(taskDiv);
        taskIndex++;
    }

    function addCollaboratorField() {
        const container = document.getElementById('collaborators-container');
        const input = document.createElement('input');
        input.type = 'email';
        input.name = 'collaborators[]';
        input.placeholder = 'Add collaborator email';
        input.className = 'mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white';
        container.appendChild(input);
    }
</script>

@endsection
