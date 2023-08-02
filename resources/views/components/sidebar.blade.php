@php 
// To update after updating this project to laravel 10
$baseUrl=URL::to('/');
$curUrl = url()->current();
$activeStyles = "bg-gray-900 text-white font-medium";
$defaultStyles = "text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium";
@endphp

<!-- component -->
<aside id="menu" class="fixed right-0 z-10 hidden flex float-right shadow-xl">
    <x-notif username="{{ $username }}" />
    <div class="text-gray-300 h-screen py-6 flex flex-col items-center overflow-y-auto bg-gray-800 sm:w-64 w-60">
        <a href="javascript:void(0);" onclick="toggleMenu()" class="ml-auto mr-6">
            <img src="{{asset("assets/icons/close.svg")}}" alt="" class="invert w-2.5 mb-3 hover:opacity-80">
        </a>
        <div class="mb-4 text-center">
            <img src="{{asset("assets/images/dp.jpg")}}" class="mx-auto h-32 rounded-full mb-2" alt="">
            <h2 class="px-5 text-xl font-semibold">{{Auth::user()->full_name}}</h2>
            <h2 class="px-5 text-sm font-">{{ '@' . Auth::user()->username}}</h2>
        </div>

        <div class="w-full px-2 text-">
            <a href="javascript:void(0);" onclick="showNotifications()" class="text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium flex items-center gap-2 p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                <h5>Notifications</h5>
            </a>
            <a href="/{{ $username }}" class="{{ $curUrl==$baseUrl . "/$username" ? $activeStyles : $defaultStyles; }} flex items-center gap-2 my-1 p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg">
                <img src="{{asset("assets/icons/profile.svg")}}" alt="" class="invert h-5 px-0.5 opacity-80">
                <h5>My Profile</h5>
            </a>
            <hr class="my-2 border-1.5 border-gray-400">
            <form action="/logout" method="POST" class="pl-3 text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg hover:bg-gray-100">
                @csrf
                <button class="flex items-center gap-2">
                    <img src="{{asset("assets/icons/logout.svg")}}" alt="" class="invert h-6">
                    <h5>Log out</h5>
                </button>
            </form>
        </div>
    </div>
</aside>