@extends('task.index')

@section('content')

<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Project Details</h2>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->name }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->description }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->start_date->format('Y-m-d') }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->end_date->format('Y-m-d') }}</p>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Owner</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ Auth::user()->email }}</p>
    </div>

    <div>
        <label for="">Priority</label>
        <p>{{ ucfirst($project->priority)}}</p>
    </div>

    <div>
        <label for="">completed</label>
        <p class="mt-1 text-lg text-gray-900 dark:text-white">{{ $project->completed ? 'Yes' : 'No' }}</p>
    </div>
    <div>
        <label for="">Collaborators</label>
        @if ($project->collaborators->isNotEmpty())
        <ul>
            @foreach ($project->collaborators as $collaborator)
            <li>{{ $collaborator }}</li>
            @endforeach
        </ul>
        @else
        <p><a href="{{'project.edit'}}">Add Collaborators</a></p>
        @endif
    </div>

    <div>
        <label for="">Tasks</label>
        @if ($project->tasks->isNotEmpty())
        <ul>
            @foreach ($project->tasks as $task)
            <li>
                {{ $task->title }} - Due: {{ $task->due_at ? $task->due_at->format('Y-m-d') : 'No due date' }}
            </li>
            @endforeach
        </ul>
        @else
        <p>No tasks added yet.</p>
        @endif
    </div>

    <div class="flex justify-end">
        <a href="{{ route('project.edit', $project->id) }}" class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">Edit Project</a>
    </div>
</div>

@endsection
