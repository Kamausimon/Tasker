@extends('task.index')
@section('content')

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 mt-3">
    <form action="{{route('task.update', $task->id)}}" method="POST" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" id="title" name="title" value="{{$task->title}}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{$task->description}}</textarea>
        </div>

        <div>
            <label for="completed" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completed</label>
            <label for="toggleFour" class="flex items-center cursor-pointer select-none text-dark dark:text-white">
                <div class="relative">
                    <input
                        type="checkbox"
                        id="toggleFour"
                        name="completed"
                        class="peer sr-only"
                        {{ $task->completed ? 'checked' : '' }} />
                    <div class="block h-8 rounded-full bg-slate-900 dark:bg-dark-2 w-14 peer-checked:bg-blue-600"></div>
                    <div class="absolute flex items-center justify-center w-6 h-6 transition bg-white rounded-full left-1 top-1 dark:bg-dark-5 peer-checked:translate-x-full peer-checked:dark:bg-white"></div>
                </div>
            </label>
        </div>

        <div>
            <label for="completed_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Completed At</label>
            <input type="datetime-local" name="completed_at" id="completed_at" value="{{ $task->completed_at ? $task->completed_at->format('Y-m-d\TH:i') : '' }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        </div>

        <div>
            <label for="due_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due At</label>
            <input type="date" name="due_at" id="due_at" value="{{ $task->due_at }}" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        </div>

        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
            <select id="priority" name="priority" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">Update Task</button>
            <button type="reset" class="w-full py-2 px-4 ml-4 bg-gray-500 text-white font-semibold rounded-md shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75">Discard Changes</button>
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
