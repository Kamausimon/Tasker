<div x-data="{ open: false }" class="flex h-screen">
    <!-- Sidebar -->
    <div :class="open ? 'translate-x-0' : '-translate-x-full'" class="bg-gray-800 text-white  space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out">
        <a href="{{route('task.index')}}" class="text-white flex items-center space-x-2 px-4">
            <img src="/images/tasker-high-resolution-logo-transparent.png" alt="">
        </a>
        <nav>

            <a href="{{ route('reports.summary') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 {{ Request::routeIs('reports.summary') ? 'bg-gray-700' : '' }}">Reports</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Calendar</a>
            <a href="{{route('task.all')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Tasks</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Projects</a>
        </nav>

        <div class="p-4 bg-gray-800 rounded-lg shadow-md">
            <h6 class="text-slate-400 ml-2 text-lg font-semibold">Recently created Project</h6>
            @if ($recentProject)
            <a href="{{ route('project.show', $recentProject->id) }}" class="ml-2 mt-2 text-white bg-gray-700 p-2 rounded-md block">
                {{$recentProject->name}}
            </a>
            @else
            <p class="ml-2 mt-2 text-gray-400">No recently created Project</p>
            @endif
        </div>

        <div class="p-4 bg-gray-800 rounded-lg shadow-md">
            <h6 class="text-slate-400 ml-2 mt-4 text-lg font-semibold">Recent Incomplete Tasks</h6>
            @if ($recentIncompleteTasks->isNotEmpty())
            <ul class="ml-2 mt-2 space-y-2">
                @foreach ($recentIncompleteTasks as $task)
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
            <p class="ml-2 mt-2 text-gray-400">No recently created incomplete tasks.</p>
            @endif
        </div>
    </div>

    <!-- Main content -->

</div>
