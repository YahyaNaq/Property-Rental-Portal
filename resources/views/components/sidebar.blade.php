@php 
// To update after updating this project to laravel 10
$baseUrl=URL::to('/');
$curUrl = url()->current();
$activeStyles = "bg-gray-900 text-white font-medium";
$defaultStyles = "text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium";
@endphp

<!-- component -->
<aside id="menu" class="fixed right-0 z-10 hidden flex float-right shadow-xl">
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