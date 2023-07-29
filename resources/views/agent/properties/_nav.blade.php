<nav class="bg-slate-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-14 items-center justify-between">
            <div class="flex items-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                    @php 
                        // To update after updating this project to laravel 10
                        $username=Auth::user()->username;
                        $baseUrl=URL::to('/') . "/$username/properties";
                        $curUrl = url()->current();
                        // dd('Base: ' . $baseUrl, "Active: " .$curUrl);
                        $activeStyles = "bg-gray-800 text-white font-semibold";
                        $defaultStyles = "bg-gray-900 text-white hover:bg-gray-700 hover:text-white ";
                    @endphp
                    <a href="/{{$username}}/properties" class="{{ $curUrl==$baseUrl ? $activeStyles : $defaultStyles; }} px-2 py-1 rounded-md text-sm">Your Properties</a>
                    <a href="/{{$username}}/properties/new" class="{{ $curUrl==$baseUrl . '/new' ? $activeStyles : $defaultStyles; }} px-2 py-1 rounded-md text-sm">Add new</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>