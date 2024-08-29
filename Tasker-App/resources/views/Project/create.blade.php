@extends('task.index')
@section('content')
<div class="container mx-auto p-6">
    <form action="{{ route('project.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="owner" class="block text-gray-700 font-bold mb-2">Owner</label>
            <input type="text" name="owner" id="owner" value="{{ Auth::user()->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
            @error('description')
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

        <div class="mb-4">
            <label for="priority" class="block text-gray-700 font-bold mb-2">Priority</label>
            <input type="text" name="priority" id="priority" value="{{ old('priority') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('priority')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="completed" class="block text-gray-700 font-bold mb-2">Completed</label>
            <input type="checkbox" name="completed" id="completed" {{ old('completed') ? 'checked' : '' }} class="mr-2 leading-tight">
            @error('completed')
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
                <input type="checkbox" name="tasks[0][completed]" class="mr-2 leading-tight"> Completed
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
            <input type="checkbox" name="tasks[${taskIndex}][completed]" class="mr-2 leading-tight"> Completed
        `;
        container.appendChild(taskDiv);
        taskIndex++;
    }
</script>
@endsection
