<x-agent.layout title="Dashboard">
    <div class="min-h-full">
        @include('agent/properties/_nav')
        @include('dashboard/_header', ['heading' => 'Your Properties'])
        <main>
            @if($properties->isNotEmpty())
                <x-search uri="/{{ request()->path() }}" />
                <div class="flex flex-wrap gap-6 mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    @foreach ($properties as $property)
                        <div class="w-[56rem] md:flex-row md:max-w-5xl flex flex-col items-start bg-white border border-gray-200 rounded-lg shadow">
                            <img class="object-cover object-center h-full w-80 rounded-t-lg md:rounded-none md:rounded-l-lg" src="{{asset("assets/images/house.jpg")}}" alt="">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <div class="ml-auto">
                                    <a href="/{{ $username }}/properties/edit/{{$property['id']}}" class="inline-flex items-center">
                                        <img src="{{asset("assets/icons/edit.svg")}}" alt="" class="w-4">
                                    </a>
                                    <a href="/{{ $username }}/properties/delete/{{$property['id']}}" class="inline-flex items-center">
                                        <img src="{{asset("assets/icons/delete.svg")}}" alt="" class="w-3.5 ml-.5 opacity-80">
                                    </a>
                                </div>
                                    <h5 class="mb-2 mr-4 text-3xl font-bold capitalize tracking-tight text-gray-900">{{ $property['title'] }}</h5>

                                <h5 class="text-sm w-max font-medium px-2 py-1 mb-2 tracking-tight bg-gray-200 rounded-lg text-gray-700">{{ $property->category->name }}</h5>
                                    <div class="flex items-center gap-1 my-2">
                                        <img src="{{asset("assets/icons/location.svg")}}" class="h-4" alt="">
                                        <h5 class="text-sm w-max font-medium capitalize tracking-tight text-gray-800">{{ $property->location->name }}, {{ $property->location->city->name }}</h5>
                                    </div>
                                <span class="flex items-end gap-x-1 text-gray-900">
                                    <h1 class="text-md font-semibold">PKR</h1>
                                    <h5 class="text-2xl font-bold">{{ number_format($property['monthly_rent']) }}</h5>
                                </span>
                                <div class="flex items-center gap-6 my-3">
                                    <a class="flex items-center gap-2">
                                        <img src="{{asset("assets/images/dp.jpg")}}" class="h-6 rounded-full" alt="">
                                        <h5 class="text-sm font-medium">{{ $property->agent->full_name; }}</h5>
                                    </a>
                                    <h1 class="text-sm text-gray-500">Posted {{ $property['created_at']->diffForHumans(); }}</h1>
                                </div>
                                <p class="text-justify mb-5 font-normal text-gray-700">{{ str_split($property['description'], 94)[0] }}...</p>
                                <a
                                href="{{ route('properties.show', ['username'=> $username, 'id' => $property['id'] ])}}"
                                class="inline-flex items-center font-medium w-[5.7rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    View ad
                                    <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                </a>
                            </div>
                        </div>             
                    @endforeach
                </div>
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="max-w-4xl">
                        {{ $properties->links() }}
                    </div>
                </div>
            @else
                @if(request(['search']))
                <div class="mx-16 my-6 px-2">
                    <h5 class="mb-1">Your have not upload any properties yet.</h5>
                    <h5 class="mb-5">Click to add now!</h5>
                    <a href="properties/new" class="inline-flex items-center font-medium px-3.5 py-2.5 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Add now
                    </a>
                </div>
                @else
                <div class="mx-16 my-6 px-2">
                    <h5 class="mb-1">None of your properties match your search.</h5>
                </div>
                @endif
            @endif
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-agent.layout>
