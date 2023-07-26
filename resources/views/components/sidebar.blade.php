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
            <img src="{{asset("assets/images/dp.jpg")}}" class="h-32 rounded-full mb-2" alt="">
            <h2 class="px-5 text-xl font-semibold">{{Auth::user()->full_name}}</h2>
            <h2 class="px-5 text-sm font-">{{Auth::user()->username}}</h2>
        </div>

        <div class="w-full px-2 text-">
            <a href="/{{ $username }}/properties" class="{{ $curUrl==$baseUrl . "/$username/properties" ? $activeStyles : $defaultStyles; }} flex items-center gap-2 my-1 p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <h5>My Properties</h5>
            </a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium flex items-center gap-2 my-1 p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h5>My Profile</h5>
            </a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white hover:font-medium flex items-center gap-2 p-1.5 focus:outline-nones transition-colors duration-200 rounded-lg hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                <h5>Notifications</h5>
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