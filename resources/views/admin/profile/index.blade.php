<x-admin.layout title="{{ $user->full_name }}">
    <div class="min-h-full">
        <x-header heading="{{ $user->id == Auth::guard('admins')->id() ? 'Your Profile' : 'Owner Profile' }}"/>
            <main class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="p- md:flex-row md:max-w-xl">
                    <div class="flex items-center gap-6">
                        <img src="{{asset("assets/images/dp.jpg")}}" class="h-36 rounded-lg" alt="">
                        <div>
                            <div class="mb-1">
                                <h5 class="text-4xl font-semibold">{{ $user->full_name }}</h5>
                                <h5 class="text-sm font-thin">{{ '@' . $user->username}}</h5>
                            </div>
                            <div class="flex items-center gap-1 mt-3">
                                <img src="{{asset("assets/icons/location.svg")}}" class="h-4 opacity-60" alt="">
                                @if ($user->city && $user->country)
                                    <h5 class="text-md text-gray-600">{{$user->city}}, {{$user->country}}</h5>
                                @elseif ($user->city)
                                    <h5 class="text-md text-gray-600"><strong>City</strong>{{$user->city}}</h5>
                                @elseif ($user->country)
                                    <h5 class="text-md text-gray-600"><strong>Country</strong>{{$user->country}}</h5>
                                @else
                                    <h5 class="text-md text-gray-600">Location not specified</h5>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 mt-1 ml-0.5">
                                <img src="{{asset("assets/icons/calendar.svg")}}" class="w-3 opacity-60" alt="">
                                <h5 class="text-xs text-gray-600">Since {{ $user->created_at->diffForHumans() }}</h5>
                            </div>
                            <a href="/" class="flex items-center gap-1 mt-3">
                                <h5 class="text-blue-700 font-medium">All Properties</h5>
                                <svg width="14" height="14" viewBox="0 0 16 16" size="14" color="#1D4ED8">
                                    <path fill="none" stroke="#1D4ED8" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="m5.183 12.336 7.672-7.672m-7.672 0h7.672v7.672"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h1 class="text-lg font-semibold">Contact Details</h1>
                        <div class="flex items-center gap-8 opacity-80 mt-1 text-">
                            <div class="flex items-center gap-2">
                                <img src="{{asset("assets/icons/mail.svg")}}" class="h-4" alt="">
                                <h5>{{ $user->email }}</h5>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" id="phone">
                                    <path fill="none" d="M0 0h24v24H0V0z"></path>
                                    <path d="M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z"></path>
                                </svg>
                                <h5>{{ $user->phone_number ?? 'Not added' }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h5 class="text-lg font-semibold">About {{ $user->full_name }}</h5>
                        <p class="mb-3 text-justify text-gray-500 dark:text-gray-400">
                            {{ $user->about ?? 'No description added' }}
                        </p>
                    </div>
                </div>
            </main>   
    </div>
</x-admin.layout>