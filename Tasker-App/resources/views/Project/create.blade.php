@extends('task.index')
@section('content')
<div class="container mx-auto p-6">
    <form action="{{route('project.store')}}" method="POST" id="projectForm" class="bg-white p-8 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="owner" class="block text-gray-700 font-bold mb-2">Owner</label>
            <input type="text" name="owner" id="owner" value="{{ Auth::user()->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <textarea name="name" id="name" class="shadow appearance-none border rounded w-full py-1 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
            @error('name')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
            @error('description')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">start date</label>
            <input type="date" id="start_date" name="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="{{ now()->format('Y-m-d') }}">
            @error('start_date')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End date</label>
            <input type="date" id="end_date" name="end_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="{{ now()->format('Y-m-d') }}">
            @error('end_date')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tags" class="block text-gray-700 font-bold mb-2">Tags</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('tags')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <!-- priority -->
        <div class="mb-4">
            <label for="priority" class="block text-gray-700 text-sm font-bold mb-2">Priority</label>
            <select id="priority" name="priority" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
            @error('priority')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>


        <div id="tasks-container" class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Tasks</label>
            <div class="task mb-2">
                <input type="text" name="tasks[0][title]" placeholder="Task Title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
                <textarea name="tasks[0][description]" placeholder="Task Description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2"></textarea>
                <input type="date" name="tasks[0][due_at]" placeholder="Due Date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
                <select name="tasks[0][priority]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>

            </div>
        </div>

        <button type="button" onclick="addTask()" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add Task</button>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Project</button>
        </div>
    </form>
</div>

<script>
    let taskIndex = 1;

    function addTask() {
        const container = document.getElementById('tasks-container');
        const taskDiv = document.createElement('div');
        taskDiv.classList.add('task', 'mb-2');
        taskDiv.innerHTML = `
            <input type="text" name="tasks[${taskIndex}][title]" placeholder="Task Title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
            <textarea name="tasks[${taskIndex}][description]" placeholder="Task Description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2"></textarea>
            <input type="date" name="tasks[${taskIndex}][due_at]" placeholder="Due Date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
            <select name="tasks[${taskIndex}][priority]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

        `;
        container.appendChild(taskDiv);
        taskIndex++;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const dueDateInput = document.getElementById('start_date');
        const today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format
        dueDateInput.setAttribute('min', today); // Set the min attribute to today's date

        dueDateInput.addEventListener('change', function() {
            if (new Date(dueDateInput.value) < new Date(today)) {
                alert('The due date cannot be in the past.');
                dueDateInput.value = today;
            }
        });
    });
</script>
@endsection
