@php 
// To update after updating this project to laravel 10
$baseUrl=URL::to('/');
$curUrl = url()->current();
$activeStyles = "bg-gray-900 text-white font-medium";
$defaultStyles = "text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium";
@endphp

<!-- component -->
<aside id="menu" class="fixed right-0 z-10 hidden flex float-right shadow-xl">
    <div class="text-gray-300 h-screen py-6 flex flex-col items-center overflow-y-auto bg-gray-800 border-gray-100 border-l sm:w-64 w-60">
        <a href="javascript:void(0);" onclick="toggleMenu()" class="ml-auto mr-6">
            <img src="{{asset("assets/icons/close.svg")}}" alt="" class="invert w-2.5 mb-3 hover:opacity-80">
        </a>
        <div class="mb-4 text-center">
            <img src="{{asset("assets/images/dp.jpg")}}" class="mx-auto h-32 rounded-full mb-2" alt="">
            <h2 class="px-5 text-xl font-semibold">{{$user->full_name}}</h2>
            <h2 class="px-5 text-sm font-">{{$user->username}}</h2>
        </div>

        <div class="w-full px-2 text-">
            <a href="/" class="{{ $curUrl==$baseUrl ? $activeStyles : $defaultStyles; }} flex items-center gap-2 my-1 p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <h5>All Properties</h5>
            </a>
            <a href="/admin/{{ $user->username }}" class="{{ $curUrl==$baseUrl . "/$user->username" ? $activeStyles : $defaultStyles; }} flex items-center gap-2 my-1 p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg">
                <img src="{{asset("assets/icons/profile.svg")}}" alt="" class="invert h-5 px-0.5 opacity-80">
                <h5>My Profile</h5>
            </a>
            <hr class="my-2 border-1.5 border-gray-400">
            <form action="{{route('admin.logout')}}" method="POST" class="pl-3 text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg hover:bg-gray-100">
                @csrf
                <button class="flex items-center gap-2">
                    <img src="{{asset("assets/icons/logout.svg")}}" alt="" class="invert h-6">
                    <h5>Log out</h5>
                </button>
            </form>
        </div>
    </div>
</aside>