<x-admin.layout title="Analytics">
    <div class="min-h-full">
        @include('admin/dashboard/_nav')
        @include('admin/dashboard/_header', ['heading' => 'Agency analytics'])
        <main>
            {{-- {{ dd($properties) }} --}}
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="flex flex-wrap gap-x-8 mb-16 gap-y-3">
                    <h5 class="basis-full my-4 text-2xl font-semibold">Total number of properties</h5>
                    <div class="text-white min-w-48 w-64 text-right px-4 py-4 bg-gradient-to-r from-sky-400 via-sky-600 to-sky-900 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Uploaded</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/upload.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsUp }}</h5>
                        </div>
                    </div>
                    <div class="text-white min-w-48 w-64 text-right px-4 py-4 bg-gradient-to-r from-indigo-300 from-10% via-indigo-600 to-indigo-900 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Rented</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/housekey.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsRented }}</h5>
                        </div>
                    </div>
                    <div class="text-white min-w-48 w-64 text-right px-4 py-4 bg-gradient-to-r from-sky-400 via-sky-600 to-sky-900 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Currently uploaded</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/upload.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyUp }}</h5>
                        </div>
                    </div>
                    <div class="text-white min-w-48 w-64 text-right px-4 py-4 bg-gradient-to-r from-indigo-300 from-10% via-indigo-600 to-indigo-900 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Currently rented</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/housekey.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyRented }}</h5>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 items-center">
                    <h5 class="my-4 text-2xl font-semibold">Properties currently uploaded</h5>
                    <h5 class="text-lg">({{count($properties)}})</h5>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="pl-4 py-3 bg-indigo-300">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
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
                                    <td class="w-4 p-4 ">
                                        {{ $property->is_rented ? 'Rented' : 'Vacant'; }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a 
                                        href="/{{$property->user->username}}/properties/edit/{{$property->id}}"
                                        class="font-medium text-blue-600 hover:underline">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a 
                                        href="/{{$property->user->username}}/properties/{{$property->id}}"
                                        class="font-medium text-green-600 hover:underline">
                                            Show
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-admin.layout>
