<div x-data="{ open: false }" class="flex h-screen">
    <!-- Sidebar -->
    <div :class="open ? 'translate-x-0' : '-translate-x-full'" class="bg-gray-800 text-white  space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out">
        <a href="{{route('task.index')}}" class="text-white flex items-center space-x-2 px-4">
            <img src="/images/tasker-high-resolution-logo-transparent.png" alt="">
        </a>
        <nav>

            <a href="{{ route('reports.summary') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 {{ Request::routeIs('reports.summary') ? 'bg-gray-700' : '' }}">Reports</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Calendar</a>
        </nav>
    </div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
        <!-- Toggle button -->
        <button @click="open = !open" class="p-2 bg-gray-800 text-white rounded-md md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Your main content goes here -->

    </div>
</div>