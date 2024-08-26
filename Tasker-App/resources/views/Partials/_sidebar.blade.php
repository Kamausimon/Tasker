<div x-data="{ open: false }" class="flex">
    <!-- Sidebar -->
    <div :class="open ? 'translate-x-0' : '-translate-x-full'" class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out">
        <a href="#" class="text-white flex items-center space-x-2 px-4">
            <span class="text-2xl font-extrabold">Tasker</span>
        </a>
        <nav>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Dashboard</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Tasks</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Projects</a>
            <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Settings</a>
        </nav>
    </div>

    <!-- Main content -->
    <div class="flex-1">
        <!-- Toggle button -->
        <button @click="open = !open" class="p-2 bg-gray-800 text-white rounded-md md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Your main content goes here -->
        <div class="p-4">
            <!-- Example content -->
            <h1 class="text-2xl font-bold">Main Content</h1>
            <p>This is the main content area.</p>
        </div>
    </div>
</div>