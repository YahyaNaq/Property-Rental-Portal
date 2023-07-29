<x-agent.layout title="{{ $property['title'] }}">
    <div class="min-h-full">
        {{-- <x-header heading={{$property}}/> --}}
        <main> 
            <div class="mx-16 my-6 w-full max-w-4xl shadow bg-white border border-gray-200 rounded-lg">
                <div class="py-5 px-5 pb-5">
                    <h5 class="text-3xl font-semibold capitalize tracking-tight text-gray-900 pb-2">{{ $property->title }}</h5>
                    <h5 class="text-sm w-max font-medium px-2 py-1 tracking-tight bg-gray-200 rounded-lg text-gray-700">{{ $property->category->name }}</h5>
                    <div class="flex items-center gap-6 my-5">
                        <a class="flex items-center gap-2">
                            <img src="{{asset("assets/images/dp.jpg")}}" class="h-8 rounded-full" alt="">
                            <h5 class="text-md font-medium">{{ $property->user->full_name }}</h5>
                        </a>
                        <h1 class="text-sm text-gray-500">Posted {{ $property['created_at']->diffForHumans() }}</h1>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-end gap-x-1 font-semibold text-gray-900">
                            <h1 class="text-lg">PKR</h1>
                            <h5 class="text-3xl">{{ number_format($property['monthly_rent']) }}</h5>
                        </span>
                        <button onclick="" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Make Offer</button>
                    </div>
                </div>
                <div class="w-full bg-white rounded-lg">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                        {{-- @php 
                            // To update after updating this project to laravel 10
                            $baseUrl = "/$username/properties/" . $property['id'];
                            $curUrl = "/" . request()->path();
                            // dd($baseUrl, $curUrl);
                            $activeStyles = "text-blue-600 border-b-2 border-blue-600";
                        @endphp --}}
                        <li class="mr-2">
                            <a id="selected" type="button" onclick="changeTab(event)" class="text-blue-600 border-b-2 border-blue-600 cursor-pointer inline-block font-medium p-4 rounded-tl-lg hover:bg-gray-100">About</a>
                        </li>
                        <li class="mr-2">
                            <a type="button" onclick="changeTab(event)" class="cursor-pointer inline-block p-4 hover:text-gray-600 hover:bg-gray-100">Photos</a>
                        </li>
                        <li class="mr-2">
                            <a type="button" onclick="changeTab(event)" class="cursor-pointer inline-block p-4 hover:text-gray-600 hover:bg-gray-100">Contact</a>
                        </li>
                    </ul>
                    <div>
                    {{-- @if($curUrl==$baseUrl) --}}
                    {{-- About --}}
                    <div id="about" class="max-h-72 overflow-auto p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800">
                        <p class="mb-3 text-gray-600 dark:text-gray-400">
                            {{ $property['description'] }}
                        </p>
                        <div class="grid grid-col-3 mb-3 text-gray-600 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <img src="{{asset("assets/icons/location.svg")}}" class="h-4" alt="">
                                <h5 class="mr-2 text-gray-700">Bedrooms</h5>
                                <h5 class="text-gray-800 font-medium">{{ $property['bedrooms'] }}</h5>
                            </div>
                            <div class="flex items-center gap-2">
                                <img src="{{asset("assets/icons/location.svg")}}" class="h-4" alt="">
                                <h5 class="mr-2 text-gray-700">Bathrooms</h5>
                                <h5 class="text-gray-800 font-medium">{{ $property['bathrooms'] }}</h5>
                            </div>
                            <div class="flex items-center gap-2">
                                <img src="{{asset("assets/icons/location.svg")}}" class="h-4" alt="">
                                <h5 class="mr-2 text-gray-700">Area</h5>
                                <h5 class="text-gray-800 font-medium">{{ $property['area'] }} sq ft</h5>
                            </div>
                            <div class="flex items-center gap-2">
                                <img src="{{asset("assets/icons/location.svg")}}" class="h-4" alt="">
                                <h5 class="mr-2 text-gray-700">Location</h5>
                                <h5 class="text-gray-800 font-medium">{{ $property['location'] }}, {{ $property['city'] }}</h5>
                            </div>
                        </div>
                    </div>
                    {{-- @elseif($curUrl==$baseUrl . '/Photos') --}}
                    {{-- Photos --}}
                    <div id="photos" class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800">
                        <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">We invest in the world’s potential</h2>
                        <!-- List -->
                        <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                            <li class="flex space-x-2 items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight">Dynamic reports and dashboards</span>
                            </li>
                            <li class="flex space-x-2 items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight">Templates for everyone</span>
                            </li>
                            <li class="flex space-x-2 items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight">Development workflow</span>
                            </li>
                            <li class="flex space-x-2 items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight">Limitless business automation</span>
                            </li>
                        </ul>
                    </div>
                    {{-- @elseif($curUrl==$baseUrl . '/Contact') --}}
                    {{-- Contact --}}
                    <div id="contact" class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800">
                        <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                            <div class="flex flex-col">
                                <dt class="mb-2 text-3xl font-extrabold">73M+</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Developers</dd>
                            </div>
                            <div class="flex flex-col">
                                <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Public repositories</dd>
                            </div>
                            <div class="flex flex-col">
                                <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                                <dd class="text-gray-500 dark:text-gray-400">Open source projects</dd>
                            </div>
                        </dl>
                    </div>
                        {{-- @endif     --}}
                    </div>
                </div>
            </div>              
        </main>
    </div>
</x-agent.layout>