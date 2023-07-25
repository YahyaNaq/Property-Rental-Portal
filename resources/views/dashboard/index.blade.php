<x-layout title="Analytics">
    <div class="min-h-full">
        @include('dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Analytics'])
        <main>
            {{-- {{ dd($properties) }} --}}
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="flex flex-wrap gap-x-8 mb-16 gap-y-3">
                    <h5 class="basis-full my-4 text-2xl font-semibold">Total number of properties by you</h5>
                    <div class="min-w-40 text-center p-6 bg-indigo-100 shadow rounded-lg">
                        <h5 class="text-lg">Uploaded</h5>
                        <h5 class="text-4xl font-bold">{{ $noOfPropsUp }}</h5>
                    </div>
                    <div class="min-w-40 text-center p-6 bg-indigo-100 shadow rounded-lg">
                        <h5 class="text-lg">Currently uploaded</h5>
                        <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyUp }}</h5>
                    </div>
                    <div class="min-w-40 text-center p-6 bg-indigo-100 shadow rounded-lg">
                        <h5 class="text-lg">Rented</h5>
                        <h5 class="text-4xl font-bold">{{ $noOfPropsRented }}</h5>
                    </div>
                    <div class="min-w-40 text-center p-6 bg-indigo-100 shadow rounded-lg">
                        <h5 class="text-lg">Currently rented</h5>
                        <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyRented }}</h5>
                    </div>
                </div>                
                <h5 class="my-4 text-2xl font-semibold">Properties currently uploaded</h5>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="pl-4 py-3 bg-indigo-200">
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
                                <th scope="col" class="px-6 py-3">
                                    Views
                                </th>
                                <th scope="col" class="p-4">
                                    <h5>Rented</h5>
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
                                    <td class="px-6 py-4">
                                        {{ $property->views->count() }}
                                    </td>
                                    <td class="w-4 p-4">
                                        <div class="flex items-center px-auto">
                                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a 
                                        href="/{{$property->user->username}}/properties/edit/{{$property->id}}"
                                        class="font-medium text-blue-600 hover:underline">
                                            Edit
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
</x-layout>
