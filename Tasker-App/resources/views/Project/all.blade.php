@extends('task.index')
@section('content')
<div class="p-6 bg-gray-800 rounded-lg shadow-md">
    <h6 class="text-slate-200 text-xl font-semibold mb-4">All Projects</h6>
    @if ($projects->isNotEmpty())
    <ul class="space-y-4">
        @foreach ($projects as $project)
        @if ($project->user_id == auth()->id() )
        <li class="flex items-center justify-between p-4 bg-gray-700 rounded-lg transition transform hover:-translate-y-1 hover:shadow-lg">
            <div>
                <a href="{{ route('project.show', $project->id) }}" class="text-blue-400 text-lg font-medium hover:underline">
                    {{ $project->name }}
                </a>
                <span class="text-sm text-gray-400 block">Created on {{ $project->created_at->format('Y-m-d') }}</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('project.edit', $project->id) }}" class="text-yellow-400 font-medium hover:text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.3 3.3c.8-.8 2-.8 2.8 0l2.6 2.6c.8.8.8 2 0 2.8l-10 10c-.2.2-.4.3-.7.3h-4c-.6 0-1-.4-1-1v-4c0-.3.1-.5.3-.7l10-10zm1.7 4.6l-2.6-2.6-9.4 9.4v2.6h2.6l9.4-9.4zm3-3l-2.6-2.6-1.4 1.4 2.6 2.6 1.4-1.4z" />
                    </svg>
                </a>
                <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 font-medium hover:text-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M9 3h6a1 1 0 0 1 1 1v1h4v2h-1v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4V5h4V4a1 1 0 0 1 1-1zm3 6h1v9h-1V9zm3 0h1v9h-1V9zm-4 0h1v9H9V9zm5-4H8v1h8V5zm-7 9h1v9H7V9z" />
                        </svg>
                    </button>
                </form>
            </div>
        </li>
        @endif
        @endforeach
    </ul>
    @else
    <p class="text-gray-400">No projects available.</p>
    @endif
</div>
@endsection
