<div class="text-white bg-slate-800">
    <nav class="flex flex-row">
        <a href="{{ route('dashboard',['id' => Auth::id()] ) }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 {{ Request::routeIs('dashboard') ? 'bg-gray-700' : '' }}">Dashboard</a>
        <a href="{{ route('task.create') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 {{ Request::routeIs('task.create') ? 'bg-gray-700' : '' }}"> Tasks</a>
        <a href="{{ route('project.create') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 {{ Request::routeIs('project.create') ? 'bg-gray-700' : '' }}"> Projects</a>
    </nav>
</div>