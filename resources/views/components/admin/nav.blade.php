<nav class="bg-gray-800 border-b border-gray-600">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
            </div>
            <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
                @php 
                    // To update after updating this project to laravel 10
                    $baseUrl=URL::to('/');
                    $curUrl = url()->current();
                    $activeStyles = "bg-gray-900 text-white";
                    $defaultStyles = "text-gray-300 hover:bg-gray-700 hover:text-white";
                @endphp
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                @auth('admins')
                    <a href="/admin/dashboard" class="{{ Str::contains($curUrl, $baseUrl . '/admin/dashboard') ? $activeStyles : $defaultStyles; }} rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
                @endauth
                    <a href="/" class="{{ $curUrl==$baseUrl ? $activeStyles : $defaultStyles; }} rounded-md px-3 py-2 text-sm font-medium">Home</a>
            </div>
            </div>
        </div>
        <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
                @auth('admins')
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div class="rounded-lg py-1.5 px-2.5 bg-gray-900">
                            <a href="javascript:void(0);" onclick="toggleMenu()" class="flex gap-2 max-w-xs items-center" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <img class="h-8 w-8 rounded-full border-gray-300 border-2 border-full" src="{{asset("assets/images/dp.jpg")}}" alt="">
                                <img class="h-4 w-4 invert opacity-80" src="{{asset("assets/icons/menu.svg")}}" alt="">
                            </a>
                        </div>
                    </div>
                @else
                    <div class="flex gap-2">
                        @if(Str::contains($curUrl, '/register'))
                        <a href="/login" class="text-white flex max-w-xs items-center rounded-md px-3 py-2 bg-indigo-700 hover:bg-indigo-800 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-indigo-800">Login</a>
                        @elseif(Str::contains($curUrl, '/login'))
                        {{-- <a href="/register" class="text-white flex max-w-xs items-center rounded-md px-3 py-2 bg-indigo-700 hover:bg-indigo-800 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-indigo-800">Register</a> --}}
                        @else
                        <a href="/login" class="text-white flex max-w-xs items-center rounded-md px-3 py-2 bg-indigo-700 hover:bg-indigo-800 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-indigo-800">Login</a>
                        <a href="/register" class="text-white flex max-w-xs items-center rounded-md px-3 py-2 bg-indigo-700 hover:bg-indigo-800 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-indigo-800">Register</a>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
        <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <button type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        </div>
    </div>
</nav>