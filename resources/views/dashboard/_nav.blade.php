<nav class="bg-slate-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-14 items-center justify-between">
            <div class="flex items-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                    @php 
                        // To update after updating this project to laravel 10
                        $baseUrl=URL::to('/') . '/dashboard';
                        $curUrl = url()->current();
                        // dd('Base: ' . $baseUrl, "Active: " .$curUrl);
                        $activeStyles = "bg-gray-800 text-white font-semibold";
                        $defaultStyles = "bg-gray-900 text-white hover:bg-gray-700 hover:text-white ";
                    @endphp
                    <a href="/dashboard" class="{{ $curUrl==$baseUrl ? $activeStyles : $defaultStyles; }} px-2 py-1 rounded-md text-sm">Your Properties</a>
                    <a href="/dashboard/add-a-new-property" class="{{ $curUrl==$baseUrl . '/add-a-new-property' ? $activeStyles : $defaultStyles; }} px-2 py-1 rounded-md text-sm">Add new</a>
                    <a href="/dashboard/analytics" class="{{ $curUrl==$baseUrl . '/analytics' ? $activeStyles : $defaultStyles; }} px-2 py-1 rounded-md text-sm">Analytics</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>