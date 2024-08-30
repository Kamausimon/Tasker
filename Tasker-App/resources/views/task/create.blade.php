@extends('task.index')

@section('content')

<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    <form action="{{route('task.store')}}" method="POST">
        @csrf
        <!-- title -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('title')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <input type="text" id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('description')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>


        <!-- due at -->
        <div class="mb-4">
            <label for="due_at" class="block text-gray-700 text-sm font-bold mb-2">Due At</label>
            <input type="date" id="due_at" name="due_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="{{ now()->format('Y-m-d') }}">
            @error('due_at')
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

        <!-- submit button -->
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create Task
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Simulate form submission and enable the dropdown
        setTimeout(function() {
            document.getElementById('completed').disabled = false;
        }, 1000); // Simulate a delay for form submission
    });

    document.addEventListener('DOMContentLoaded', function() {
        const dueDateInput = document.getElementById('due_date');
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
