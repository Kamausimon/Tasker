@extends('task.index');
@section('content')
<div>
    <h6 class="text-slate-400 ml-2 text-lg font-semibold">All Tasks</h6>
    @if ($tasks->isNotEmpty())
    <ul class="ml-2 mt-2 space-y-2">
        @foreach ($tasks as $task)
        <li class="flex items-center justify-between p-2 bg-gray-700 rounded-md">
            <div>
                <a href="{{ route('task.show', $task->id) }}" class="text-blue-400 hover:underline">
                    {{ $task->title }}
                </a>
                <span class="text-sm text-gray-500 block">Created on {{ $task->created_at->format('Y-m-d') }}</span>
            </div>
        </li>
        @endforeach
    </ul>
    @else
    <p class="ml-2 mt-2 text-gray-400">No tasks available.</p>
    @endif
</div>
@endsection
