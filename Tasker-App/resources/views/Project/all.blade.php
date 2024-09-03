@extends('task.index')
@section('content')
<div>
    <div class="p-4 bg-gray-800 rounded-md shadow-md">
        <h6 class="text-slate-400 ml-2 text-lg font-semibold">All Projects</h6>
        @if ($projects->isNotEmpty())
        <ul class="ml-2 mt-2 space-y-2">
            @foreach ($projects as $project)
            <li class="flex items-center justify-between p-2 bg-gray-700 rounded-md">
                <div>
                    <a href="{{ route('project.show', $project->id) }}" class="text-blue-400 hover:underline">
                        {{ $project->name }}
                    </a>
                    <span class="text-sm text-gray-500 block">Created on {{ $project->created_at->format('Y-m-d') }}</span>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('project.edit', $project->id) }}" class="text-yellow-400 hover:underline mt-1 ml-2">Edit</a>
                    <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:underline"> <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                <path fill="grey" d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z" />
                            </svg></button>

                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        @else
        <p class="ml-2 mt-2 text-gray-400">No tasks available.</p>
        @endif
    </div>
</div>
@endsection
