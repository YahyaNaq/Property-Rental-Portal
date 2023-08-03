<x-agent.layout title="Agent Analytics">
    <div class="min-h-full">
        @include('agent/dashboard/_nav')
        @include('agent/dashboard/_header', ['heading' => 'Agent Analytics'])
        <main>
            {{-- {{ dd($properties) }} --}}
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="flex flex-wrap gap-x-8 mb-16 gap-y-3">
                    <h5 class="basis-full my-4 text-2xl font-semibold">Total number of properties by you</h5>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-sky-100 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Uploaded</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/upload.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsUp }}</h5>
                        </div>
                    </div>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-indigo-200 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Rented</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/housekey.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsRented }}</h5>
                        </div>
                    </div>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-sky-100 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Currently uploaded</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/upload.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyUp }}</h5>
                        </div>
                    </div>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-indigo-200 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Currently rented</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/housekey.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyRented }}</h5>
                        </div>
                    </div>
                </div>
                <h5 class="my-4 text-2xl font-semibold">Properties currently uploaded</h5>
                @if($properties->isNotEmpty())         
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="pl-4 py-3 bg-indigo-100">
                        <p class="mb-0.5 text-gray-900 font-semibold">
                            Note: Following list also includes the properties that are not verified.
                        </p>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-100 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Location
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    City
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Views
                                </th>
                                <th scope="col" class="text-center p-4">
                                    Status
                                </th>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                    </div>
                                </th>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($properties as $property)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text">
                                        {{ $property['title'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $property->category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $property['location'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $property['city'] }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $property->views->count() }}
                                    </td>
                                    <td class="w-4 p-4">
                                        {{ $property->is_rented ? 'Rented' : 'Vacant'; }}
                                    </td>
                                    @if(!$property['is_rented'])
                                        <td class="px-6 py-4">
                                            <a 
                                            href="/{{$property->agent->username}}/properties/edit/{{$property->id}}"
                                            class="font-medium text-blue-600 hover:underline">
                                                Edit
                                            </a>
                                        </td>
                                    @else
                                        <td class="px-6 py-4"></td>
                                    @endif
                                    <td class="px-6 py-4">
                                        <a 
                                        href="/{{$property->agent->username}}/properties/{{$property->id}}"
                                        class="font-medium text-green-600 hover:underline">
                                            Show
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div>
                    <p class="text">You don't have any properies currently uploaded.</p>
                    <p class="text mb-4">Add a new property to start with.</p>                  
                    <a href="/" target="_blank" class="inline-flex items-center font-medium w-[5.15rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Add now</a>
                </div>
                @endif

            </div>
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-agent.layout>
