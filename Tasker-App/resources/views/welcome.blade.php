<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('Partials._head')

<body class=" bg-slate-400 text-white">

    <!-- main body container-->
    <div class="bg-slate-950 m-10  p-10 rounded-md">
        <!-- nav -->
        <div class="flex justify-between">
            <div class="mt-4">
                <img src="/images/tasker-high-resolution-logo-transparent.png" alt="logo" class="  w-24 ">
            </div>
            <!-- #region -->
            <div class="flex mt-4 space-x-6 text-sm">
                <a href="">What's new</a>
                <a href="">pricing</a>
            </div>

            <div class="mt-4">
                @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                    <a
                        href="{{ url('/tasks') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Dashboard
                    </a>
                    @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div>

        </div>
        <!-- end of nav -->

        <!-- main content -->

        <div class="bg-slate-100 mt-6 ml-3 mr-3 p-4 grid grid-cols-3 gap-4">
            <div class="">
                <img class="rounded-2xl h-5/6" src="/images/stressed man.jpg" alt="Economist working in office">
            </div>

            <div class="flex flex-col justify-center">
                <h1 class="text-8xl font-serif font-semibold mb-2 mt-0 text-slate-700">Stressed About Tasks and Projects?</h1>
                <p class="text-gray-500 mt-8">
                    Tasker is a simple yet powerful task management app designed to help you organize your to-do lists, prioritize tasks,
                    and boost productivity. Whether you're managing personal projects or collaborating with a team,
                    Tasker makes it easy to stay on track and get things done.
                </p>
            </div>

            <div>
                <img class="rounded-2xl" src="/images/Task.jpg" alt="Task management">
            </div>
        </div>

        <div class="mt-2 ml-3 mr-3 p-4 grid grid-cols-3 gap-x-6 gap-y-3">
            <div class="col-span-1 bg-slate-100 rounded-md">
                <h6 class="font-bold text-xl text-slate-500">how does it work?</h6>
                <p class="text-sm mt-2 mb-1 text-slate-300"> Just register and enjoy</p>
                <img class="rounded-2xl" src="/images/Task.jpg" alt="Task management">
            </div>

            <div class="col-span-2 bg-slate-100 rounded-md">
                <img src="/images/Task3.jpg" alt="">
            </div>
        </div>

        <!-- end of main content -->


    </div>
    <!-- footer -->
    @include('Partials._footer')
    <!-- end of footer -->

</body>

</html>